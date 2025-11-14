const tips = [
  "Rinse your containers before recycling.",
  "Avoid black plastic – many facilities can't sort it.",
  "Compost your food waste for nutrient-rich soil.",
  "Recycle electronics at certified e-waste centers.",
  "Use reusable bags, bottles, and containers."
];

let current = 0;
const tipBox = document.getElementById("tip-box");

function showTip() {
  tipBox.textContent = tips[current];
  current = (current + 1) % tips.length;
}

setInterval(showTip, 3000);
showTip();
