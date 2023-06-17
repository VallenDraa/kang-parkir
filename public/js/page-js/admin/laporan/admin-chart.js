import {
  kapasitasParkiranChart,
  dataMotorPeriodikChart,
  pilihanPeriodeMotor,
} from "./admin-laporan.js";

export function adminChart() {
  // chart kapasitas parkiran
  new Chart(kapasitasParkiranChart, {
    type: "pie",
    data: {
      labels: ["Terisi", "Kosong"],
      datasets: [
        {
          data: [
            window.kapasitasParkiran.persen_terisi,
            100 - window.kapasitasParkiran.persen_terisi,
          ],
          borderWidth: 0,
          backgroundColor: [
            "rgba(239, 68, 68, 0.6)",
            "rgba(59, 130, 246, 0.6)",
          ],
        },
      ],
    },
  });

  // chart data motor perhari
  const labelMotorPerhari = Object.keys(window.dataMotorPerPeriode);
  const dataMotorPerhari = Object.values(window.dataMotorPerPeriode);

  new Chart(dataMotorPeriodikChart, {
    type: "bar",
    data: {
      labels: labelMotorPerhari,
      datasets: [
        {
          label: "Jumlah Motor Perhari",
          data: dataMotorPerhari,
          backgroundColor: "rgba(59, 130, 246, 0.6)",
          borderWidth: 0,
        },
      ],
    },
    options: {
      scales: {
        y: { beginAtZero: true },
      },
    },
  });

  pilihanPeriodeMotor.addEventListener("click", e => {
    const periode = window.periodeValid.includes(e.target.value)
      ? e.target.value
      : window.periodeValid[0];

    if (window.periodeDataAktif !== periode) {
      window.location.href = `?periode-data=${periode}`;
    }
  });
}
