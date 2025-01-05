document.addEventListener("DOMContentLoaded", () => {
  const cardsContainer = document.getElementById("cards-container");
  const paginationContainer = document.getElementById("pagination-container");
  const sortBySelect = document.getElementById("sort-by");
  const sortOrderSelect = document.getElementById("sort-order");

  const allFilter = document.getElementById("all-filter");
  const userFilter = document.getElementById("user-filter");
  const progressFilter = document.getElementById("progress-filter");

  let currentPage = 1;
  const itemsPerPage = 6;

  let grids = phpData;
  let filteredGrids = phpData;

  allFilter.addEventListener("click", () => {
    filteredGrids = grids;
    currentPage = 1;
    displayGrids();
  });

  userFilter.addEventListener("click", () => {
    if (username) {
      filteredGrids = grids.filter((grid) => grid.id_user === username);
    } else {
      filteredGrids = grids; // Fallback if username is not defined
    }
    currentPage = 1;
    displayGrids();
  });

  progressFilter.addEventListener("click", () => {
    if (username) {
      filteredGrids = grids.filter((grid) => {
        return grids_saved.some((saved) => saved.id_grille === grid.id_grille);
      });
    } else {
      filteredGrids = grids; // Fallback if username is not defined
    }
    currentPage = 1;
    displayGrids();
  });

  sortBySelect.addEventListener("change", () => {
    currentPage = 1;
    displayGrids();
  });

  sortOrderSelect.addEventListener("change", () => {
    currentPage = 1;
    displayGrids();
  });

  function displayGrids() {
    const sortBy = sortBySelect.value;
    const sortOrder = sortOrderSelect.value;

    filteredGrids.sort((a, b) => {
      let comparison = 0;

      if (sortBy === "creation_date") {
        comparison = new Date(a.date) - new Date(b.date);
      } else if (sortBy === "difficulté") {
        const difficultyOrder = ["facile", "moyen", "difficile"];
        comparison =
          difficultyOrder.indexOf(a.difficulté) -
          difficultyOrder.indexOf(b.difficulté);
      }

      return sortOrder === "asc" ? comparison : -comparison;
    });

    // Paginate grids
    const startIndex = (currentPage - 1) * itemsPerPage;
    const paginatedGrids = filteredGrids.slice(
      startIndex,
      startIndex + itemsPerPage
    );

    // Display grids
    cardsContainer.innerHTML = "";
    paginatedGrids.forEach((grid) => {
      const card = document.createElement("div");
      card.classList.add("game-card");
      card.innerHTML = `
                <h2>${grid.nom}</h2>
                <p class="creator">Par: ${grid.id_user}</p>
                <p class="difficulty">
                    <span class="difficulty-circle ${grid.difficulté.toLowerCase()}"></span>
                    ${
                      grid.difficulté.charAt(0).toUpperCase() +
                      grid.difficulté.slice(1)
                    }
                </p>
                <p class="estimated-time">Temps estimé: ${
                  grid.estimated_time
                } mins</p>
                <p class="description">${grid.description}</p>
                <p class="creation-date">Date de création: ${new Date(
                  grid.date
                ).toLocaleDateString()}</p>
                <button class="play-button" data-grid-id="${
                  grid.id_grille
                }">Jouer</button>
            `;
      cardsContainer.appendChild(card);
    });

    setupPagination(Math.ceil(filteredGrids.length / itemsPerPage));

    document.querySelectorAll(".play-button").forEach((button) => {
      button.addEventListener("click", function (event) {
        const gridId = button.getAttribute("data-grid-id");
        handlePlayButtonClick(gridId);
      });
    });
  }

  function setupPagination(totalPages) {
    paginationContainer.innerHTML = "";
    for (let i = 1; i <= totalPages; i++) {
      const button = document.createElement("button");
      button.textContent = i;
      button.classList.add("pagination-button");
      if (i === currentPage) {
        button.classList.add("active");
        button.style.backgroundColor = "#ff595a";
        button.style.color = "white";
      }
      button.addEventListener("click", () => {
        currentPage = i;
        displayGrids();
      });
      paginationContainer.appendChild(button);
    }
  }

  function handlePlayButtonClick(gridId) {
    $.ajax({
      url: "index.php?action=grids",
      method: "GET",
      data: gridId,

      success: function (response) {
        console.log(response);
        window.location.href = "index.php?action=grids&gridId=" + gridId;
        return response;
      },
      error: function (xhr, status, error) {
        console.log("Status:", status);
        console.log("Requête renvoyée :", xhr.responseText);
      },
    });
  }

  // Call displayGrids to display the grids initially
  displayGrids();
});
