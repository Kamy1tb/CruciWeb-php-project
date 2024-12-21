document.addEventListener("DOMContentLoaded", () => {
  const gridContainer = document.getElementById("grid-container");
  const toggleButton = document.getElementById("toggle-direction");
  let isHorizontal = true; // Default writing direction is horizontal
  let currentFocusedCell = null; // Store the currently focused cell

  // Variables for the number of rows and columns
  const numRows = 5;
  const numCols = 5;
  const darkSquareProbability = 0.2; // Probability of a cell being a dark square

  // Initialize the grid content array with empty strings and some dark squares (represented by '0')
  const gridContent = Array.from({ length: numRows }, () =>
    Array.from({ length: numCols }, () =>
      Math.random() < darkSquareProbability ? "0" : ""
    )
  );

  // Function to generate a random sequence of 5 letters
  const generateRandomHint = () => {
    const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let hint = "";
    for (let i = 0; i < 5; i++) {
      hint += letters.charAt(Math.floor(Math.random() * letters.length));
    }
    return hint;
  };

  // Generate random hints for horizontal and vertical clues
  const horizontalClues = Array.from(
    { length: numRows },
    (_, index) => `${index + 1}. ${generateRandomHint()}`
  );
  const verticalClues = Array.from(
    { length: numCols },
    (_, index) => `${index + 1}. ${generateRandomHint()}`
  );

  // Add column headers
  const alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  for (let col = 0; col <= numCols; col++) {
    const headerCell = document.createElement("div");
    headerCell.classList.add("header-cell");
    headerCell.textContent = col === 0 ? "" : alphabet[col - 1];
    gridContainer.appendChild(headerCell);
  }

  // Générer la grille avec les en-têtes de lignes
  gridContent.forEach((row, rowIndex) => {
    // Add row header
    const headerCell = document.createElement("div");
    headerCell.classList.add("header-cell");
    headerCell.textContent = rowIndex + 1;
    gridContainer.appendChild(headerCell);

    row.forEach((cell, colIndex) => {
      const cellDiv = document.createElement("div");
      cellDiv.classList.add("grid-cell");

      if (cell === "0") {
        cellDiv.classList.add("dark-cell"); // Add class for dark squares
        cellDiv.contentEditable = false; // Make the cell non-editable
      } else {
        cellDiv.contentEditable = true; // Make the cell editable

        // Add event listener to enforce single-character input, alphabetic characters only, and move to the next cell
        cellDiv.addEventListener("input", (e) => {
          let previousInput = gridContent[rowIndex][colIndex];
          let inputChar = e.data ? e.data.toUpperCase() : "";

          if (/^[A-Z]$/.test(inputChar) || inputChar === "") {
            cellDiv.textContent = inputChar; // Convert the input to uppercase or clear the cell
          } else {
            cellDiv.textContent = previousInput; // Restore the previous valid input if the new input is not valid
          }

          // Move to the next available cell
          if (e.inputType === "insertText" && /^[A-Z]$/.test(inputChar)) {
            let nextCell;
            if (isHorizontal) {
              nextCell = cellDiv.nextElementSibling;
              while (nextCell && nextCell.classList.contains("dark-cell")) {
                nextCell = nextCell.nextElementSibling;
              }
            } else {
              const currentIndex = Array.from(gridContainer.children).indexOf(
                cellDiv
              );
              nextCell = gridContainer.children[currentIndex + numCols + 1];
              while (nextCell && nextCell.classList.contains("dark-cell")) {
                nextCell =
                  gridContainer.children[
                    Array.from(gridContainer.children).indexOf(nextCell) +
                      numCols +
                      1
                  ];
              }
            }
            if (!nextCell || nextCell.classList.contains("header-cell")) {
              nextCell = null; // Stop at the last character of the word
            }
            if (nextCell) {
              nextCell.focus();
            }
          }

          // Update the grid content array
          gridContent[rowIndex][colIndex] = cellDiv.textContent;
          console.log(gridContent); // For debugging purposes
        });

        // Add event listener to highlight the current row or column
        cellDiv.addEventListener("focus", () => {
          currentFocusedCell = cellDiv; // Store the currently focused cell
          clearHighlights();
          highlightCurrentLineOrColumn(rowIndex, colIndex);
        });
      }

      gridContainer.appendChild(cellDiv);
    });
  });

  // Afficher les indices
  const horizontalCluesContainer = document.getElementById("horizontal-clues");
  horizontalClues.forEach((clue) => {
    const clueItem = document.createElement("div");
    clueItem.textContent = clue;
    horizontalCluesContainer.appendChild(clueItem);
  });

  const verticalCluesContainer = document.getElementById("vertical-clues");
  verticalClues.forEach((clue) => {
    const clueItem = document.createElement("div");
    clueItem.textContent = clue;
    verticalCluesContainer.appendChild(clueItem);
  });

  // Update grid container style to match the number of rows and columns
  gridContainer.style.gridTemplateColumns = `repeat(${numCols + 1}, 30px)`; // Adjust for column headers
  gridContainer.style.gridTemplateRows = `repeat(${numRows + 1}, 30px)`; // Adjust for row headers

  // Toggle direction button event listener
  toggleButton.addEventListener("click", () => {
    isHorizontal = !isHorizontal;

    // Refocus and highlight the current line or column
    if (currentFocusedCell) {
      const currentIndex = Array.from(gridContainer.children).indexOf(
        currentFocusedCell
      );
      const rowIndex = Math.floor(currentIndex / (numCols + 1)) - 1;
      const colIndex = (currentIndex % (numCols + 1)) - 1;
      clearHighlights();
      highlightCurrentLineOrColumn(rowIndex, colIndex);
      currentFocusedCell.focus();
    }
  });

  // Function to clear all highlights
  function clearHighlights() {
    const highlightedCells = gridContainer.querySelectorAll(".highlighted");
    highlightedCells.forEach((cell) => cell.classList.remove("highlighted"));
  }

  // Function to highlight the current row or column
  function highlightCurrentLineOrColumn(rowIndex, colIndex) {
    if (isHorizontal) {
      for (let col = 0; col < numCols; col++) {
        const cell =
          gridContainer.children[(rowIndex + 1) * (numCols + 1) + col + 1];
        if (cell && !cell.classList.contains("dark-cell")) {
          cell.classList.add("highlighted");
        }
      }
    } else {
      for (let row = 0; row < numRows; row++) {
        const cell =
          gridContainer.children[(row + 1) * (numCols + 1) + colIndex + 1];
        if (cell && !cell.classList.contains("dark-cell")) {
          cell.classList.add("highlighted");
        }
      }
    }
  }
});
