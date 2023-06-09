import {
  actionDialog,
  editUserBtns,
  formEditUser,
  formTambahMotor,
} from "./admin-index.js";

export function editUserHandler() {
  editUserBtns?.forEach(btn => {
    btn.addEventListener("click", async () => {
      actionDialog?.openDialog();

      const idUser = btn.getAttribute("data-id-user");
      const { username, is_admin: isAdmin } = users.find(u => u.id === idUser);

      // ambil data motor milik user
      try {
        const HTMLListMotor = await fetch(
          "../../../../parkiran-dua/api/cari-motor.php",
          {
            method: "POST",
            body: JSON.stringify({ "id-user": parseInt(idUser) }),
          },
        ).then(res => res.text());

        // isi list motor di dalam dialog
        qs("#list-motor-user").innerHTML = HTMLListMotor;

        // isi data di dalam form
        qs("#id-user-edit").value = idUser;
        qs("[name='username']").value = username;
        qs("[name='is-admin']").checked = isAdmin === "1";

        formEditUser?.classList.remove("hidden");
        formTambahMotor?.classList.add("hidden");
      } catch (error) {
        console.error(error);
      }
    });
  });
}
