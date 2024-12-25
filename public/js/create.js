let currentStep = 1;

function showStep(step) {
  document.querySelectorAll(".form-step").forEach((element, index) => {
    element.style.display = index + 1 === step ? "block" : "none";
  });
  document.querySelectorAll(".step").forEach((element, index) => {
    element.classList.toggle("active", index + 1 === step);
  });
}

function nextStep() {
  if (currentStep < 3) {
    currentStep++;
    showStep(currentStep);
  }
}

function prevStep() {
  if (currentStep > 1) {
    currentStep--;
    showStep(currentStep);
  }
}

document.addEventListener("DOMContentLoaded", () => {
  showStep(currentStep);
});
