document.addEventListener("DOMContentLoaded", () => {
  const gridContainer = document.getElementById("grid-container");
  const horizontal = document.getElementById("horizontal");
  const vertical = document.getElementById("vertical");
  const horizontalCluesContainer = document.getElementById("horizontal-clues");
  const verticalCluesContainer = document.getElementById("vertical-clues");

  let isHorizontal = true;
  let currentFocusedCell = null;
  const alphabet = " ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  case_noire = JSON.parse(grid.case_noire);
  clues = JSON.parse(grid.clues);
  console.log(clues);

  const horizontalGroups = {};
  const verticalGroups = {};

  Object.keys(clues).forEach((key) => {
    const [prefix] = key.split("."); // Extract the part before the '.'
    const clueValue = clues[key];

    // Determine whether the key is horizontal or vertical
    const isVertical = /[a-zA-Z]/.test(prefix);

    // Group the clues based on the prefix
    const group = isVertical ? verticalGroups : horizontalGroups;

    if (!group[prefix]) {
      // If the group for this prefix doesn't exist, create it
      const groupContainer = document.createElement("div");
      groupContainer.classList.add("clue-group");
      group[prefix] = groupContainer;

      // Add the prefix at the start
      const prefixLabel = document.createElement("span");
      prefixLabel.textContent = `${prefix}. `;
      groupContainer.appendChild(prefixLabel);

      // Append the group container to the appropriate parent container
      if (isVertical) {
        verticalCluesContainer.appendChild(groupContainer);
      } else {
        horizontalCluesContainer.appendChild(groupContainer);
      }
    }

    // Add the clue to the group
    const groupContainer = group[prefix];

    // Check if there are already clues in the group
    if (groupContainer.querySelectorAll("span").length > 1) {
      // Add a separator if the group already has clues
      const separator = document.createTextNode(" / ");
      groupContainer.appendChild(separator);
    }

    const clueElement = document.createElement("span");
    clueElement.textContent = clueValue;
    groupContainer.appendChild(clueElement);
  });

  // Variables for the number of rows and columns
  const height = grid.height;
  const width = grid.width;
  gridContainer.innerHTML = ""; // Clear the grid container

  // Add column headers
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

    // Add row header
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
        // Add event listener to enforce single-character input, alphabetic characters only, and move to the next cell
        cell.addEventListener("input", (e) => {
          let inputChar = e.data ? e.data.toUpperCase() : "";
          if (/^[A-Z]$/.test(inputChar) || inputChar === "") {
            cell.textContent = inputChar;
          } else {
            cell.textContent = "";
          }
          // Move to the next available cell
          if (e.inputType === "insertText" && /^[A-Z]$/.test(inputChar)) {
            let nextCell;
            if (isHorizontal) {
              nextCell = cell.nextElementSibling;
              while (nextCell && nextCell.classList.contains("highlighted")) {
                nextCell = nextCell.nextElementSibling;
              }
            } else {
              const currentRow = cell.parentElement; // Get the parent grid-row of the current cell
              const currentRowIndex = Array.from(
                gridContainer.children
              ).indexOf(currentRow); // Get the index of the current row
              const currentCellIndex = Array.from(currentRow.children).indexOf(
                cell
              ); // Get the index of the current cell in the row

              // Get the next row
              const nextRow = gridContainer.children[currentRowIndex + 1]; // Move to the next row (y + 1)
              if (nextRow) {
                nextCell = nextRow.children[currentCellIndex]; // Get the cell in the same column (x)

                // Skip highlighted cells
                while (nextCell && nextCell.classList.contains("highlighted")) {
                  const nextRowIndex =
                    Array.from(gridContainer.children).indexOf(nextRow) + 1;
                  const furtherNextRow = gridContainer.children[nextRowIndex]; // Move to the next row
                  nextCell = furtherNextRow
                    ? furtherNextRow.children[currentCellIndex]
                    : null; // Get the corresponding cell
                }
              }
            }

            if (!nextCell || nextCell.classList.contains("header-cell")) {
              nextCell = null; // Stop at the last character of the word
            }
            if (nextCell) {
              nextCell.focus();
            }
          }
        });

        cell.addEventListener("focus", () => {
          currentFocusedCell = cell; // Store the currently focused cell
          clearHighlights();
          highlightCurrentLineOrColumn(currentFocusedCell);
        });
      }
      row.appendChild(cell);
    }
    gridContainer.appendChild(row);
  }

  function clearHighlights() {
    const highlightedCells = gridContainer.querySelectorAll(".lit");
    highlightedCells.forEach((cell) => cell.classList.remove("lit"));
  }

  function highlightCurrentLineOrColumn(cell) {
    if (isHorizontal) {
      // Highlight the entire row
      const row = cell.parentElement; // Get the specific grid-row
      if (row) {
        Array.from(row.children).forEach((cell) => {
          // Corrected here to loop through children
          if (
            !cell.classList.contains("highlighted") &&
            !cell.classList.contains("header-cell")
          ) {
            cell.classList.add("lit");
          }
        });
      }
    } else {
      const row = cell.parentElement; // Get the grid-row that the cell is in
      const colIndex = Array.from(row.children).indexOf(cell); // Get the column index of the cell within the row
      // Highlight the entire column
      for (let row = 0; row < gridContainer.children.length; row++) {
        // Start from index 0 if it's the first row
        const gridRow = gridContainer.children[row]; // Get each grid-row
        const cell = gridRow.children[colIndex]; // Get the specific cell in the column
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
  horizontal.addEventListener("click", () => {
    isHorizontal = true;
    currentFocusedCell.focus();
  });
  vertical.addEventListener("click", () => {
    isHorizontal = false;
    currentFocusedCell.focus();
  });
});
