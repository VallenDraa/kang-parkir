import {
  actionDialog,
  dialogTitle,
  editUserBtns,
  formEditUser,
  formTambahMotor,
  hapusUserforms,
} from "./admin-index.js";
import { qs } from "../../../utils/dom-selector.js";

export function editUserHandler() {
  editUserBtns?.forEach(btn => {
    btn.addEventListener("click", () => {
      actionDialog?.openDialog();
      dialogTitle.textContent = "Edit User";

      const idUser = parseInt(btn.getAttribute("data-id-user"));

      // TODO: error handling ketika idUser tidak ada
      if (!idUser) {
        console.error("Id user tidak ada");
      }

      const { username, is_admin: isAdmin } = window.users.find(
        u => u.id === idUser,
      );

      // ambil data motor milik user
      const motorArr = window.dataMotorMilikUser[idUser];

      let htmlListMotor = "";

      // isi list motor di dalam dialog
      if (motorArr.length === 0) {
        htmlListMotor = `
          <tr>
            <td colspan="10" class="p-2 font-medium text-center text-slate-400">
              User Tidak Punya Motor
            </td>
          </tr>
        `;
      } else {
        motorArr.forEach((m, i) => {
          htmlListMotor += `
            <tr class="[&>td]:p-2 text-center even:bg-slate-50">
              <td>${i + 1}</td>
              <td>${m.plat}</td>
              <td>${m.lokasi_parkir}</td>
              <td>${new Date(m.tanggal_masuk).toLocaleString()}</td>
            </tr>
          `;
        });
      }

      // set isi list motor milik user
      qs("#list-motor-user").innerHTML = htmlListMotor;

      // isi data di dalam form
      qs("#id-user-edit").value = idUser;
      qs("[name='username']").value = username;
      qs("[name='is-admin']").checked = isAdmin === 1;

      formEditUser?.classList.remove("hidden");
      formTambahMotor?.classList.add("hidden");
    });
  });

  // konfirmasi ketika menghapus motor
  hapusUserforms?.forEach(form => {
    form.addEventListener("submit", e => {
      e.preventDefault();

      const konfirmasiHapus = confirm(
        "Apakah anda yakin ingin menghapus user ini ?",
      );

      if (konfirmasiHapus) form.submit();
    });
  });
}
