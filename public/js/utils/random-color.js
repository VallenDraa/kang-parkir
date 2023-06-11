export function randomRgb(transparan = false) {
  const r = Math.floor(Math.random() * 256);
  const g = Math.floor(Math.random() * 256);
  const b = Math.floor(Math.random() * 256);

  // Construct the RGB color string
  const color = transparan
    ? `rgba(${r}, ${g}, ${b}, 0.3)`
    : `rgb(${r}, ${g}, ${b})`;

  return color;
}
