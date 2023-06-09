import {
  actionDialog,
  formEditUser,
  formTambahMotor,
  hapusMotorforms,
  platUserBaruCheckbox,
  platUserLamaSelection,
  submitMotorBtn,
  tambahMotorBtn,
} from "./admin-index.js";

export function adminMotorHandler() {
  // tampilkan modal ketika tombol tambah motor ditekan
  tambahMotorBtn?.addEventListener("click", () => {
    actionDialog?.openDialog();

    formEditUser?.classList.add("hidden");
    formTambahMotor?.classList.remove("hidden");
  });

  // konfirmasi ketika menghapus motor
  hapusMotorforms?.forEach(form => {
    form.addEventListener("submit", e => {
      e.preventDefault();

      const konfirmasiHapus = confirm(
        "Apakah anda yakin ingin menghapus motor ini ?",
      );

      if (konfirmasiHapus) form.submit();
    });
  });

  // tutup modal ketika mengsubmit motor baru
  submitMotorBtn?.addEventListener("click", () => {
    if (inputPlat.value !== "") {
      actionDialog?.hideDialog();
    }
  });

  // matikan opsi untuk memasukkan plat ke user lama
  platUserBaruCheckbox?.addEventListener("change", e => {
    if (e.target.checked) {
      platUserLamaSelection.setAttribute("disabled", e.target.checked);
    } else {
      if (opsiUser.length > 0)
        platUserLamaSelection.removeAttribute("disabled");
    }
  });
}
