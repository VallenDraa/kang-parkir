import { randomRgb } from "../../../utils/random-color.js";
import {
  kapasitasParkiranChart,
  dataMotorPerhariChart,
  userMotorTerbanyakChart,
  motorDurasiParkirTerlamaChart,
} from "./admin-laporan.js";

export function adminChart() {
  // chart data motor perhari
  const labelMotorPerhari = Object.keys(window.dataMotorPerhari);
  const dataMotorPerhari = Object.values(window.dataMotorPerhari);
  const jumlahPerHari = dataMotorPerhari.map(data => data.length);

  new Chart(dataMotorPerhariChart, {
    type: "bar",
    data: {
      labels: labelMotorPerhari,
      datasets: [
        {
          label: "Jumlah Motor Perhari",
          data: jumlahPerHari,
          backgroundColor: randomRgb(true),
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: { beginAtZero: true },
      },
    },
  });

  // chart kapasitas parkiran
  new Chart(kapasitasParkiranChart, {
    type: "pie",
    data: {
      labels: ["Terisi", "Kosong"],
      datasets: [
        {
          data: [window.kapasitasParkiran, 100 - window.kapasitasParkiran],
          backgroundColor: [
            "rgba(255, 99, 132, 0.3)",
            "rgba(54, 162, 235, 0.3)",
          ],
        },
      ],
    },
  });

  // chart top singko user dengan motor terbanyak
  // const usernameLabels = window.userMotorTerbanyak.map(u => u.username);
  // const jumlahMotorPerUser = window.userMotorTerbanyak.map(u => u.jumlah_motor);

  // new Chart(userMotorTerbanyakChart, {
  //   type: "bar",
  //   data: {
  //     labels: usernameLabels,
  //     datasets: [
  //       {
  //         label: "Top 10 User Dengan Motor Terbanyak",
  //         data: jumlahMotorPerUser,
  //         backgroundColor: randomRgb(true),
  //         borderWidth: 1,
  //       },
  //     ],
  //   },
  //   options: {
  //     scales: {
  //       y: { beginAtZero: true },
  //     },
  //   },
  // });

  // chart top singko durasi parkir terlama
  // new Chart(motorDurasiParkirTerlamaChart, {
  //   type: "bar",
  //   data: {
  //     labels: usernameLabels,
  //     datasets: [
  //       {
  //         label: "Top 10 User Dengan Motor Terbanyak",
  //         data: jumlahMotorPerUser,
  //         backgroundColor: randomRgb(true),
  //         borderWidth: 1,
  //       },
  //     ],
  //   },
  //   options: {
  //     scales: {
  //       y: { beginAtZero: true },
  //     },
  //   },
  // });
}
