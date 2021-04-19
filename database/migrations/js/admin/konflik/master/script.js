  class UI {
      constructor() {
          this.table = $('#konflik'),
              this.buttonTambah = document.getElementById('tambah-jenis'),
              this.modals = $('#modal-konflik'),
              this.title = document.querySelector('.modal-title'),
              this.simpan = document.getElementById('simpan'),
              this.id = document.getElementById('id'),
              this.deskripsi = document.getElementById('deskripsi'),
              this.tbody = document.getElementById('tbody');
      }
      /* DataTable */
      loadData() {
          this.table.DataTable({
              processing: true,
              serverSide: true,
              ajax: process_env_url + "/table/master/konflik",
              columns: [{
                      data: 'DT_RowIndex',
                      name: 'id'
                  },
                  {
                      data: 'deskripsi_konflik',
                      name: 'deskripsi_konflik'
                  },
                  {
                      data: 'action',
                      name: 'action'
                  },
              ],
              "order": [
                  [0, "desc"]
              ],
          });
      }
      /*submit data*/
      async submitData() {
          loading();
          let deskripsi = this.deskripsi.value;
          let id = this.id.value;
          const url = process_env_url + "/simpan/master/konflik";
          let datas = {
              deskripsi: deskripsi,
              id: id
          };
          try {
              const response = await fetch(url, {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
                  },
                  body: JSON.stringify(datas)
              });
              matikanLoading();
              const data = await response.json();
              let icon = '';
              if (data.error === undefined) {
                  const success = Object.entries(data.success);
                  success.map(function ([key, value]) {
                      hapusvalidasi(key);
                  })
                  icon = 'success';
                  this.modals.modal('hide');
                  this.deskripsi.value = '';
                  this.id.value = '';
                  this.table.DataTable().ajax.reload();
              } else {
                  const error = Object.entries(data.error);
                  error.map(function ([key, value]) {
                      hapusvalidasi(key);
                      const pesan = document.getElementById(key);
                      const text = document.querySelector(`.${key}`);
                      pesan.parentElement.classList.add('has-danger');
                      text.textContent = value;
                  });
                  icon = 'error';
              }
              swal({
                  title: "Pesan!",
                  text: data.message,
                  icon: icon
              });
          } catch (error) {
              matikanLoading();
              console.log(error);
          }
      }

      /* Delete Data */
      deleteData(element) {
          const url = process_env_url + '/hapus/master/konflik/' + element.dataset.id;
          swal({
                  title: "Are you sure?",
                  text: "Ingin Menghapus? , anda akan kehilangan data master konflik!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                  if (willDelete) {
                      loading();
                      fetch(url, {
                              method: "GET",
                              headers: {
                                  'Content-type': 'application/json'
                              },
                          })
                          .then(res => res.json())
                          .then((data) => {
                              matikanLoading();
                              this.table.DataTable().ajax.reload();
                              swal({
                                  title: "Pesan!",
                                  text: data.message,
                                  icon: "success",
                              });
                          });
                  } else {
                      swal({
                          title: "Pesan!",
                          text: "anda telah membatalkan menghapus jenis konflik ",
                          icon: "success",
                      });
                  }
              });
      }

      /* Edit Data */
      editData(element) {
          const id = element.dataset.id;
          const deskripsi = element.dataset.deskripsi;
          this.id.value = id;
          this.deskripsi.value = deskripsi;
          this.title.textContent = 'Edit Master Konflik';
          this.modals.modal({
              backdrop: 'static'
          });
      }
  }


  document.addEventListener('DOMContentLoaded', function () {
      const ui = new UI();
      ui.loadData();
      ui.buttonTambah.addEventListener('click', function () {
          ui.title.textContent = 'Tambah Master Konflik';
          ui.modals.modal({
              backdrop: 'static'
          });
      });
      ui.simpan.addEventListener('click', function (event) {
          event.preventDefault();
          ui.submitData();
      })
      ui.tbody.addEventListener('click', function (event) {
          if (event.target.parentElement.classList.contains('btn-delete')) {
              ui.deleteData(event.target.parentElement);
          } else if (event.target.parentElement.classList.contains('btn-edit')) {
              ui.editData(event.target.parentElement);
          }
      })
  });
