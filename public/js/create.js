let currentStep = 1;
let gridData = {};

function showStep(step) {
  document.querySelectorAll(".form-step").forEach((element, index) => {
    element.style.display = index + 1 === step ? "block" : "none";
  });
  document.querySelectorAll(".step").forEach((element, index) => {
    element.classList.toggle("active", index + 1 === step);
  });
}

function nextStep() {
  if (currentStep === 1 && !validateStep1()) {
    return;
  }
  if (currentStep === 2 && !validateStep2()) {
    return;
  }
  if (currentStep < 3) {
    currentStep++;
    showStep(currentStep);
    if (currentStep === 2) {
      generateGrid();
      document.querySelector(
        ".step-indicator :nth-child(2)"
      ).style.backgroundColor = "#ff595a";
      document.querySelector(
        ".step-indicator :nth-child(3)"
      ).style.backgroundColor = "#ff595a";
    } else if (currentStep === 3) {
      document.querySelector(
        ".step-indicator :nth-child(4)"
      ).style.backgroundColor = "#ff595a";
      document.querySelector(
        ".step-indicator :nth-child(5)"
      ).style.backgroundColor = "#ff595a";
      prepareGridForStep3();
      generateClues();
    }
  }
}

function prevStep() {
  if (currentStep > 1) {
    currentStep--;
    showStep(currentStep);
  }
  if (currentStep === 2) {
    document.querySelector(
      ".step-indicator :nth-child(5)"
    ).style.backgroundColor = "#606060";
    document.querySelector(
      ".step-indicator :nth-child(4)"
    ).style.backgroundColor = "#606060";
  } else if (currentStep === 1) {
    document.querySelector(
      ".step-indicator :nth-child(3)"
    ).style.backgroundColor = "#606060";
    document.querySelector(
      ".step-indicator :nth-child(2)"
    ).style.backgroundColor = "#606060";
  }
}

document.addEventListener("DOMContentLoaded", () => {
  showStep(currentStep);
});

function validateStep1() {
  const gridName = document.getElementById("grid-name").value;
  const difficulty = document.getElementById("difficulty").value;
  const height = document.getElementById("height").value;
  const width = document.getElementById("width").value;
  const estimatedTime = document.getElementById("estimated-time").value;
  const description = document.getElementById("description").value;

  if (
    !gridName ||
    !difficulty ||
    !height ||
    !width ||
    !estimatedTime ||
    !description
  ) {
    alert("Veuillez remplir tous les champs.");
    return false;
  }
  return true;
}

function validateStep2() {
  const gridName = document.getElementById("grid-name").value;
  const difficulty = document.getElementById("difficulty").value;
  const height = document.getElementById("height").value;
  const width = document.getElementById("width").value;
  const estimatedTime = document.getElementById("estimated-time").value;
  const description = document.getElementById("description").value;
  const blackSquares = [];

  document.querySelectorAll(".grid-row").forEach((row, rowIndex) => {
    row.querySelectorAll(".grid-cell").forEach((cell, cellIndex) => {
      if (cell.classList.contains("highlighted")) {
        blackSquares.push({ x: cellIndex + 1, y: rowIndex });
      }
    });
  });

  gridData = {
    gridName: gridName,
    difficulty: difficulty,
    height: height,
    width: width,
    estimatedTime: estimatedTime,
    description: description,
    blackSquares: blackSquares,
  };

  return true;
}

function generateGrid() {
  const height = document.getElementById("height").value;
  const width = document.getElementById("width").value;
  const gridContainer = document.getElementById("grid-container");
  gridContainer.innerHTML = ""; // Clear previous grid

  const alphabet = " ABCDEFGHIJKLMNOPQRSTUVWXYZ";

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
      cell.addEventListener("click", () => {
        cell.classList.toggle("highlighted");
      });
      row.appendChild(cell);
    }
    gridContainer.appendChild(row);
  }
}

function prepareGridForStep3() {
  const gridContainerStep3 = document.getElementById("grid-container-step3");
  const gridContainer = document.getElementById("grid-container");
  gridContainerStep3.innerHTML = gridContainer.innerHTML; // Copy grid from step 2

  document
    .querySelectorAll("#grid-container-step3 .grid-cell")
    .forEach((cell, index) => {
      if (!cell.classList.contains("highlighted")) {
        cell.contentEditable = true;
        cell.addEventListener("input", (e) => {
          let inputChar = e.data ? e.data.toUpperCase() : "";
          if (/^[A-Z]$/.test(inputChar)) {
            cell.textContent = inputChar; // Convert the input to uppercase
            moveToNextCell(index);
          } else {
            cell.textContent = ""; // Clear the cell if the input is not valid
          }
        });
      }
    });
}

function moveToNextCell(currentIndex) {
  const cells = document.querySelectorAll("#grid-container-step3 .grid-cell");
  let nextIndex = currentIndex + 1;
  while (
    nextIndex < cells.length &&
    cells[nextIndex].classList.contains("highlighted")
  ) {
    nextIndex++;
  }
  if (nextIndex < cells.length) {
    cells[nextIndex].focus();
  }
}

function generateClues() {
  const height = gridData.height;
  const width = gridData.width;
  const blackSquares = gridData.blackSquares;

  console.log("black squares", blackSquares);
  console.log("height", height);
  console.log("width", width);

  const cluesForm = document.getElementById("clues-form");
  cluesForm.innerHTML = "";

  let clueCount = 0;
  let wordLength = 0;
  // Generate horizontal clues
  for (let i = 1; i <= height; i++) {
    clueCount = 0;
    let j = 1;
    while (j <= width) {
      while (isBlackSquare(j, i, blackSquares) && j <= width) {
        ++j;
      }
      if (j === width) break;
      wordLength = 0;
      while (
        j + wordLength <= width &&
        !isBlackSquare(j + wordLength, i, blackSquares)
      ) {
        wordLength++;
      }
      if (wordLength > 1) {
        clueCount++;
        const clueGroup = document.createElement("div");
        clueGroup.classList.add("clue-group");
        const label = document.createElement("label");
        label.textContent = `Horizontal ${i}.${clueCount}`;
        const input = document.createElement("input");
        input.type = "text";
        input.name = `${i}.${clueCount}`;
        input.required = true;
        clueGroup.appendChild(label);
        clueGroup.appendChild(input);
        cluesForm.appendChild(clueGroup);
        j += wordLength;
      }
      ++j;
    }
  }

  clueCount = 0;
  wordLength = 0;
  // Generate vertical clues
  for (let j = 1; j <= width; j++) {
    clueCount = 0;
    let i = 1;
    while (i <= height) {
      while (isBlackSquare(i, j, blackSquares) && i <= height) {
        ++i;
      }
      if (i === height) break;
      wordLength = 0;
      while (
        i + wordLength <= height &&
        !isBlackSquare(j, i + wordLength, blackSquares)
      ) {
        wordLength++;
      }
      if (wordLength > 1) {
        clueCount++;
        const clueGroup = document.createElement("div");
        clueGroup.classList.add("clue-group");
        const label = document.createElement("label");
        label.textContent = `Vertical ${j}.${clueCount}`;
        const input = document.createElement("input");
        input.type = "text";
        input.name = `${j}.${clueCount}`;
        input.required = true;
        clueGroup.appendChild(label);
        clueGroup.appendChild(input);
        cluesForm.appendChild(clueGroup);
        i += wordLength;
      }
      ++i;
    }
  }
}

function isBlackSquare(x, y, blackSquares) {
  return blackSquares.some((square) => square.x === x && square.y === y);
}

document
  .getElementById("submit-button")
  .addEventListener("click", generateFinalObject);

function generateFinalObject() {
  const clues = {};
  document.querySelectorAll(".clue-group input").forEach((input) => {
    const name = input.name;
    const value = input.value;
    clues[name] = value;
  });

  const solutions = {};

  // Generate horizontal solutions
  for (let i = 1; i <= gridData.height; i++) {
    let clueCount = 0;
    let j = 1;
    while (j <= gridData.width) {
      while (
        isBlackSquare(j, i, gridData.blackSquares) &&
        j <= gridData.width
      ) {
        ++j;
      }
      if (j === gridData.width) break;
      let wordLength = 0;
      let word = "";
      while (
        j + wordLength <= gridData.width &&
        !isBlackSquare(j + wordLength, i, gridData.blackSquares)
      ) {
        const cell = document.querySelector(
          `#grid-container-step3 .grid-row:nth-child(${
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

  // Generate vertical solutions
  for (let j = 1; j <= gridData.width; j++) {
    let clueCount = 0;
    let i = 1;
    while (i <= gridData.height) {
      while (
        isBlackSquare(j, i, gridData.blackSquares) &&
        i <= gridData.height
      ) {
        ++i;
      }
      if (i === gridData.height) break;
      let wordLength = 0;
      let word = "";
      while (
        i + wordLength <= gridData.height &&
        !isBlackSquare(j, i + wordLength, gridData.blackSquares)
      ) {
        const cell = document.querySelector(
          `#grid-container-step3 .grid-row:nth-child(${
            i + wordLength + 1
          }) .grid-cell:nth-child(${j + 1})`
        );
        word += cell.textContent;
        wordLength++;
      }
      if (wordLength > 1) {
        clueCount++;
        solutions[`${j}.${clueCount}`] = word;
        i += wordLength;
      }
      ++i;
    }
  }

  const finalObject = {
    gridData: gridData,
    clues: clues,
    solutions: solutions,
  };

  console.log(JSON.stringify(finalObject));
  $.ajax({
    url: '../public/index.php?action=create',
    method: 'POST',
    data: finalObject, 
  
    success: function (response) {
        console.log(response);
        window.location.href = '../public/index.php';
        return response;
    },
    error: function (xhr, status, error) {
      console.log("Status:", status);
      console.log("Requête renvoyée :", xhr.responseText);
    }
});
}
