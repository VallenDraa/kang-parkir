import {
  halamanBerikutnyaBtn,
  halamanSebelumnyaBtn,
  indikatorHalaman,
  searchDataTabel,
  tabelUserMotor,
} from "./admin-index.js";

export function adminCariDataTabel() {
  const tBody = tabelUserMotor.querySelector("tbody");

  searchDataTabel?.addEventListener("keyup", async () => {
    if (window.tabAktif === "user") {
      dataUser(tBody);
    } else {
      dataMotor(tBody);
    }
  });
}

function dataMotor(tbody) {}

async function dataUser(tBody) {
  try {
    const {
      users,
      halaman_aktif,
      total_halaman,
      halaman_berikutnya,
      halaman_sebelumnya,
    } = await fetch(
      `../../../../parkiran-dua/api/cari-user-dari-keyword.php?keyword=${searchDataTabel.value}&halaman-aktif=${window.halamanAktif}`,
    ).then(res => res.json());

    // setting konten tabel
    let HTMLKonten = "";
    users.forEach((user, i) => {
      HTMLKonten += `
        <tr class="[&>td]:p-2 text-center even:bg-gray-100">
          <td>${i + 1}</td>
          <td>${user.username}</td>
          <td>${user.jumlah_motor}</td>
          <td>
            <form action="../lib/action/hapus-user.action.php" id="hapus-user-form" method="POST">
              <input type="hidden" name="id-user" value="${user.id}" />

              <!-- tombol user -->
              <div class="flex items-center justify-center gap-2">
                <button 
                  id="edit-user-btn" 
                  type="button" 
                  data-id-user="${user.id}" 
                  class="px-3 py-2 text-2xl text-blue-500 transition-colors duration-200 rounded-lg hover:bg-gray-200 active:bg-gray-300"
                >
                  <i class="drop-shadow fa-regular fa-pen-to-square"></i>
                </button>

                <button id="hapus-user-btn" class="px-3 py-2 text-2xl text-red-500 transition-colors duration-200 rounded-lg hover:bg-red-200 active:bg-red-300">
                  <i class="drop-shadow fa-regular fa-trash-can"></i>
                </button>
              </div>
            </form>
          </td>
        </tr>
        `;
    });
    tBody.innerHTML = HTMLKonten;

    // settting pagination
    indikatorHalaman.textContent = `${halaman_aktif} / ${total_halaman}`;
    halamanBerikutnyaBtn.href =
      halaman_berikutnya !== null
        ? `?tab=${window.tabAktif}&halaman=${halaman_berikutnya}`
        : "#";

    halamanSebelumnyaBtn.href =
      halaman_sebelumnya !== null
        ? `?tab=${window.tabAktif}&halaman=${halamanSebelumnyaBtn}`
        : "#";
  } catch (error) {
    console.error(error);
  }
}
