const canvas = document.getElementById("canvas-stopwatch");
const ctx = canvas.getContext("2d");

let startTime = null;
let elapsedTime = 0;
let timerInterval = null;

ctx.font = "bold 60px Arial";

function drawTime() {
  let time = elapsedTime;

  const hours = Math.floor(time / (1000 * 60 * 60));
  time %= 3600000;
  const minutes = Math.floor(time / (1000 * 60));
  time %= 60000;
  const seconds = Math.floor(time / 1000);
  const milliseconds = Math.floor((time % 1000) / 10);

  const h = hours.toString().padStart(2, '0');
  const m = minutes.toString().padStart(2, '0');
  const s = seconds.toString().padStart(2, '0');
  const ms = milliseconds.toString().padStart(2, '0');

  ctx.clearRect(0, 0, canvas.width, canvas.height);
  ctx.textBaseline = "middle";

  const centerX = canvas.width / 2;
  const centerY = canvas.height / 2;

  const fragments = [
    { text: h, color: "purple" },
    { text: ":", color: "black" },
    { text: m, color: "orange" },
    { text: ":", color: "black" },
    { text: s, color: "green" },
    { text: ":", color: "black" },
    { text: ms, color: "red" }
  ];

  // Measure total width
  let totalWidth = 0;
  fragments.forEach(f => {
    totalWidth += ctx.measureText(f.text).width;
  });

 
  let x = centerX - totalWidth / 2;

  // Draw each fragment
  fragments.forEach(f => {
    ctx.fillStyle = f.color;
    ctx.fillText(f.text, x, centerY);
    x += ctx.measureText(f.text).width;
  });
}

function startTimer() {
  if (!timerInterval) {
    startTime = Date.now() - elapsedTime;
    timerInterval = setInterval(() => {
      elapsedTime = Date.now() - startTime;
      drawTime();
    }, 10);
  }
}

function stopTimer() {
  clearInterval(timerInterval);
  timerInterval = null;
}

function resetTimer() {
  stopTimer();
  elapsedTime = 0;
  drawTime();
}


drawTime();