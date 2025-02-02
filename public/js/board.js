const alphabet = " ABCDEFGHIJKLMNOPQRSTUVWXYZ";

document.addEventListener("DOMContentLoaded", () => {
  const gridContainer = document.getElementById("grid-container");
  const horizontalCluesContainer = document.getElementById("horizontal-clues");
  const verticalCluesContainer = document.getElementById("vertical-clues");

  let isHorizontal = true;
  let currentFocusedCell = null;
  case_noire = JSON.parse(grid.case_noire);
  clues = JSON.parse(grid.clues);
  let progress = {};
  if (userProgress) {
    progress = JSON.parse(userProgress.solution);
  }
  const horizontalGroups = {};
  const verticalGroups = {};

  Object.keys(clues).forEach((key) => {
    const [prefix] = key.split(".");
    const clueValue = clues[key];

    const isVertical = /[a-zA-Z]/.test(prefix);

    const group = isVertical ? verticalGroups : horizontalGroups;

    if (!group[prefix]) {
      const groupContainer = document.createElement("div");
      groupContainer.classList.add("clue-group");
      group[prefix] = groupContainer;

      const prefixLabel = document.createElement("span");
      prefixLabel.textContent = `${prefix}. `;
      groupContainer.appendChild(prefixLabel);

      if (isVertical) {
        verticalCluesContainer.appendChild(groupContainer);
      } else {
        horizontalCluesContainer.appendChild(groupContainer);
      }
    }

    const groupContainer = group[prefix];

    if (groupContainer.querySelectorAll("span").length > 1) {
      const separator = document.createTextNode(" / ");
      groupContainer.appendChild(separator);
    }

    const clueElement = document.createElement("span");
    clueElement.textContent = clueValue;
    groupContainer.appendChild(clueElement);
  });

  const height = grid.height;
  const width = grid.width;
  gridContainer.innerHTML = "";

  const headerRow = document.createElement("div");
  headerRow.classList.add("grid-row");
  for (let col = 0; col < parseInt(width, 10) + 1; col++) {
    const headerCell = document.createElement("div");
    headerCell.classList.add("header-cell");
    headerCell.textContent = alphabet[col];
    headerRow.appendChild(headerCell);
  }
  gridContainer.appendChild(headerRow);

  for (let i = 0; i < height; i++) {
    const row = document.createElement("div");
    row.classList.add("grid-row");

    const headerCell = document.createElement("div");
    headerCell.classList.add("header-cell");
    headerCell.textContent = i + 1;
    row.appendChild(headerCell);

    for (let j = 0; j < width; j++) {
      const cell = document.createElement("div");
      cell.classList.add("grid-cell");
      if (
        case_noire.some(
          (c) => c.x === String(Number(j) + 1) && c.y === String(Number(i) + 1)
        )
      ) {
        cell.classList.add("highlighted");
      } else {
        cell.contentEditable = true;
        cell.addEventListener("input", (e) => {
          let inputChar = e.data ? e.data.toUpperCase() : "";
          if (/^[A-Z]$/.test(inputChar) || inputChar === "") {
            cell.textContent = inputChar;
          } else {
            cell.textContent = "";
          }
          if (e.inputType === "insertText" && /^[A-Z]$/.test(inputChar)) {
            let nextCell;
            if (isHorizontal) {
              nextCell = cell.nextElementSibling;
              while (nextCell && nextCell.classList.contains("highlighted")) {
                nextCell = nextCell.nextElementSibling;
              }
            } else {
              const currentRow = cell.parentElement;
              const currentRowIndex = Array.from(
                gridContainer.children
              ).indexOf(currentRow);
              const currentCellIndex = Array.from(currentRow.children).indexOf(
                cell
              );

              const nextRow = gridContainer.children[currentRowIndex + 1];
              if (nextRow) {
                nextCell = nextRow.children[currentCellIndex];

                while (nextCell && nextCell.classList.contains("highlighted")) {
                  const nextRowIndex =
                    Array.from(gridContainer.children).indexOf(nextRow) + 1;
                  const furtherNextRow = gridContainer.children[nextRowIndex];
                  nextCell = furtherNextRow
                    ? furtherNextRow.children[currentCellIndex]
                    : null;
                }
              }
            }

            if (!nextCell || nextCell.classList.contains("header-cell")) {
              nextCell = null;
            }
            if (nextCell) {
              nextCell.focus();
            }
          }
        });

        cell.addEventListener("focus", () => {
          currentFocusedCell = cell;
          clearHighlights();
          highlightCurrentLineOrColumn(currentFocusedCell);
        });
      }
      row.appendChild(cell);
    }
    gridContainer.appendChild(row);
  }

  if (progress) {
    for (let i = 1; i <= grid.height; i++) {
      let clueCount = 0;
      let j = 1;
      while (j <= grid.width) {
        while (isBlackSquare(j, i, case_noire) && j <= grid.width) {
          ++j;
        }
        if (j === grid.width) break;
        let wordLength = 0;
        let word = "";
        while (
          j + wordLength <= grid.width &&
          !isBlackSquare(j + wordLength, i, case_noire)
        ) {
          wordLength++;
        }
        if (wordLength > 1) {
          clueCount++;
          const key = `${i}.${clueCount}`;
          if (progress[key]) {
            for (let k = 0; k < wordLength; k++) {
              const cell = document.querySelector(
                `#grid-container .grid-row:nth-child(${
                  i + 1
                }) .grid-cell:nth-child(${j + k + 1})`
              );
              if (cell && !cell.classList.contains("highlighted")) {
                cell.textContent = progress[key][k];
              }
            }
          }
          j += wordLength;
        }
        ++j;
      }
    }

    for (let j = 1; j <= grid.width; j++) {
      let clueCount = 0;
      let i = 1;
      while (i <= grid.height) {
        while (isBlackSquare(j, i, case_noire) && i <= grid.height) {
          ++i;
        }
        if (i === grid.height) break;
        let wordLength = 0;
        let word = "";
        while (
          i + wordLength <= grid.height &&
          !isBlackSquare(j, i + wordLength, case_noire)
        ) {
          wordLength++;
        }
        if (wordLength > 1) {
          clueCount++;
          const key = `${alphabet[j]}.${clueCount}`;
          if (progress[key]) {
            for (let k = 0; k < wordLength; k++) {
              const cell = document.querySelector(
                `#grid-container .grid-row:nth-child(${
                  i + k + 1
                }) .grid-cell:nth-child(${j + 1})`
              );
              if (cell && !cell.classList.contains("highlighted")) {
                cell.textContent = progress[key][k];
              }
            }
          }
          i += wordLength;
        }
        ++i;
      }
    }
  }

  function clearHighlights() {
    const highlightedCells = gridContainer.querySelectorAll(".lit");
    highlightedCells.forEach((cell) => cell.classList.remove("lit"));
  }

  function highlightCurrentLineOrColumn(cell) {
    if (isHorizontal) {
      const row = cell.parentElement;
      if (row) {
        Array.from(row.children).forEach((cell) => {
          if (
            !cell.classList.contains("highlighted") &&
            !cell.classList.contains("header-cell")
          ) {
            cell.classList.add("lit");
          }
        });
      }
    } else {
      const row = cell.parentElement;
      const colIndex = Array.from(row.children).indexOf(cell);
      for (let row = 0; row < gridContainer.children.length; row++) {
        const gridRow = gridContainer.children[row];
        const cell = gridRow.children[colIndex];
        if (
          cell &&
          !cell.classList.contains("highlighted") &&
          !cell.classList.contains("header-cell")
        ) {
          cell.classList.add("lit");
        }
      }
    }
  }

  const horizontal = document.getElementById("horizontal");
  const vertical = document.getElementById("vertical");

  horizontal.addEventListener("click", () => {
    isHorizontal = true;
    horizontal.classList.add("active");
    vertical.classList.remove("active");
    currentFocusedCell.focus();
  });

  vertical.addEventListener("click", () => {
    isHorizontal = false;
    vertical.classList.add("active");
    horizontal.classList.remove("active");
    currentFocusedCell.focus();
  });

  const modal = document.getElementById("congratulations-modal");
  const closeButton = document.querySelector(".close-button");

  closeButton.addEventListener("click", () => {
    modal.style.display = "none";
  });

  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });

  document
    .getElementById("submit-solution")
    .addEventListener("click", function () {
      const answers = JSON.parse(grid.solutions);
      const blackSquares = JSON.parse(grid.case_noire);

      const gridContainer = document.getElementById("grid-container");
      const rows = gridContainer.querySelectorAll(".grid-row");
      let allCellsFilled = true;

      rows.forEach((row) => {
        const cells = row.querySelectorAll(".grid-cell");
        cells.forEach((cell) => {
          if (
            !cell.classList.contains("highlighted") &&
            !cell.textContent.trim()
          ) {
            allCellsFilled = false;
          }
        });
      });

      if (!allCellsFilled) {
        alert("Veuillez remplir toutes les cellules de la grille.");
        return;
      }

      const solutions = {};

      for (let i = 1; i <= grid.height; i++) {
        let clueCount = 0;
        let j = 1;
        while (j <= grid.width) {
          while (isBlackSquare(j, i, blackSquares) && j <= grid.width) {
            ++j;
          }
          if (j === grid.width) break;
          let wordLength = 0;
          let word = "";
          while (
            j + wordLength <= grid.width &&
            !isBlackSquare(j + wordLength, i, blackSquares)
          ) {
            const cell = document.querySelector(
              `#grid-container .grid-row:nth-child(${
                i + 1
              }) .grid-cell:nth-child(${j + wordLength + 1})`
            );
            word += cell.textContent;
            wordLength++;
          }
          if (wordLength > 1) {
            clueCount++;
            solutions[`${i}.${clueCount}`] = word;
            j += wordLength;
          }
          ++j;
        }
      }

      for (let j = 1; j <= grid.width; j++) {
        let clueCount = 0;
        let i = 1;
        while (i <= grid.height) {
          while (isBlackSquare(j, i, blackSquares) && i <= grid.height) {
            ++i;
          }
          if (i === grid.height) break;
          let wordLength = 0;
          let word = "";
          while (
            i + wordLength <= grid.height &&
            !isBlackSquare(j, i + wordLength, blackSquares)
          ) {
            const cell = document.querySelector(
              `#grid-container .grid-row:nth-child(${
                i + wordLength + 1
              }) .grid-cell:nth-child(${j + 1})`
            );
            word += cell.textContent;
            wordLength++;
          }
          if (wordLength > 1) {
            clueCount++;
            solutions[`${alphabet[j]}.${clueCount}`] = word;
            i += wordLength;
          }
          ++i;
        }
      }

      const hashSolution = (solution) => {
        const hash = CryptoJS.SHA256(solution);
        return hash.toString(CryptoJS.enc.Hex);
      };

      const hashSolutions = (solutions) => {
        const hashedSolutions = {};
        for (const key in solutions) {
          hashedSolutions[key] = hashSolution(solutions[key]);
        }
        return hashedSolutions;
      };

      (async () => {
        const hashedSolutions = hashSolutions(solutions);

        const areObjectsEqual = (obj1, obj2) => {
          const keys1 = Object.keys(obj1);
          const keys2 = Object.keys(obj2);

          if (keys1.length !== keys2.length) return false;

          return keys1.every((key) => obj1[key] === obj2[key]);
        };

        if (areObjectsEqual(hashedSolutions, answers)) {
          modal.style.display = "block";
        } else {
          alert("La solution est incorrecte.");
        }
      })();
    });
});

function isBlackSquare(x, y, blackSquares) {
  return blackSquares.some((square) => square.x == x && square.y == y);
}

document.getElementById("save-solution").addEventListener("click", function () {
  const blackSquares = JSON.parse(grid.case_noire);

  const gridContainer = document.getElementById("grid-container");
  const rows = gridContainer.querySelectorAll(".grid-row");

  const solutions = {};

  for (let i = 1; i <= grid.height; i++) {
    let clueCount = 0;
    let j = 1;
    while (j <= grid.width) {
      while (isBlackSquare(j, i, blackSquares) && j <= grid.width) {
        ++j;
      }
      if (j === grid.width) break;
      let wordLength = 0;
      let word = "";
      while (
        j + wordLength <= grid.width &&
        !isBlackSquare(j + wordLength, i, blackSquares)
      ) {
        const cell = document.querySelector(
          `#grid-container .grid-row:nth-child(${i + 1}) .grid-cell:nth-child(${
            j + wordLength + 1
          })`
        );
        word += cell.textContent.trim() || " ";
        wordLength++;
      }
      if (wordLength > 1) {
        clueCount++;
        solutions[`${i}.${clueCount}`] = word;
        j += wordLength;
      }
      ++j;
    }
  }

  for (let j = 1; j <= grid.width; j++) {
    let clueCount = 0;
    let i = 1;
    while (i <= grid.height) {
      while (isBlackSquare(j, i, blackSquares) && i <= grid.height) {
        ++i;
      }
      if (i === grid.height) break;
      let wordLength = 0;
      let word = "";
      while (
        i + wordLength <= grid.height &&
        !isBlackSquare(j, i + wordLength, blackSquares)
      ) {
        const cell = document.querySelector(
          `#grid-container .grid-row:nth-child(${
            i + wordLength + 1
          }) .grid-cell:nth-child(${j + 1})`
        );
        word += cell.textContent.trim() || " ";
        wordLength++;
      }
      if (wordLength > 1) {
        clueCount++;
        solutions[`${alphabet[j]}.${clueCount}`] = word;
        i += wordLength;
      }
      ++i;
    }
  }

  const finalObject = {
    gridId: grid.id_grille,
    gridData: solutions,
  };

  $.ajax({
    url: "index.php?action=saved",
    method: "POST",
    data: finalObject,

    success: function (response) {
      console.log(response);
      console.log(finalObject);
      return response;
    },
    error: function (xhr, status, error) {
      console.log("error:", error);
      console.log("Status:", status);
      console.log("Requête renvoyée :", xhr.responseText);
    },
  });
});
