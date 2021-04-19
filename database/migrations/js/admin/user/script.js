class User {
    constructor(id,nama,email,username,satker) {
        this.id = id;
        this.nama = nama;
        this.email = email;
        this.username = username;
        this.satker = satker;
    }
}

class UI {
    /* variable element */
     static DOMStrings = {
            tableUser:"#table-user",
            btnTambah:"#btn-tambah",
            btnEdit: "#simpanEdit",
            submitForm: '#formSubmit',
            submitFormEdit: '#formEditSubmit',
            Tbody :'#tbody',
            modalEdit :'#modal-edit-user',
        }

    /* load table */
   static loadTable() {
        $(UI.DOMStrings.tableUser).DataTable({
            processing: true,
            serverSide: true,
            responsive:true,
            ajax: process_env_url + "/table/user",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                 {
                     data: 'email',
                     name: 'email'
                 },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'level_satker',
                    name: 'level_satker'
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

    /* submit Data Tambah User */

   static async submitDataTambah() {
         loading();
         const form = document.querySelector(UI.DOMStrings.submitForm);
         const formData = new FormData(form);
         const url = process_env_url+"/simpan/user";
         try {
             const response = await axios({
                 method: "post",
                 data: formData,
                 url: url,
             });
             matikanLoading();
             let icon = '';
             const data = await response.data;
             if(data.error ===  undefined) {
                const success = Object.entries(data.success);
                success.map(([key, value]) => {
                    hapusvalidasi(key);
                })
                icon = 'success';
                form.reset();
               $(UI.DOMStrings.tableUser).DataTable().ajax.reload();
             } else {
                 const error = Object.entries(data.error);
                 error.map(([key,value]) => {
                    hapusvalidasi(key);
                    console.log(key);
                    const pesan = document.getElementById(key);
                    const text = document.querySelector(`.${key}`);
                    pesan.parentElement.classList.add('has-danger');
                    text.textContent = value;
                    icon ='error';
                 })
             }
             swal({
                 title: "Pesan!",
                 text: data.message,
                 icon: icon
             });
         } catch (error) {
             matikanLoading();
             alert('Maaf ada kesalahan diserver');
             console.log(error);
         }
    }

    /* submit Data Edit User */

    static async submitDataEdit() {
        loading();
        const form = document.querySelector(UI.DOMStrings.submitFormEdit);
        const formData = new FormData(form);
        const url = process_env_url + "/simpanEdit/user";
        try {
            const response = await axios({
                method: "post",
                data: formData,
                url: url,
            });
            matikanLoading();
            let icon = '';
            const data = await response.data;
            console.log(data);
            if (data.error === undefined) {
                const success = Object.entries(data.success);
                success.map(function ([key, value]) {
                    hapusvalidasi(key);
                })
                icon = 'success';
                form.reset();
                $(UI.DOMStrings.tableUser).DataTable().ajax.reload();
                 $(UI.DOMStrings.modalEdit).modal('hide');
            } else {
                const error = Object.entries(data.error);
                error.map(([key, value]) => {
                    hapusvalidasi(key);
                    console.log(key);
                    const pesan = document.getElementById(`edit_${key}`);
                    const text = document.querySelector(`.edit_${key}`);
                    pesan.parentElement.classList.add('has-danger');
                    text.textContent = value;
                    icon = 'error';
                })
            }
            swal({
                title: "Pesan!",
                text: data.message,
                icon: icon
            });
        } catch (error) {
            matikanLoading();
            alert('Maaf ada kesalahan diserver');
            console.log(error);
        }
    }

    /* Edit User */
    static editUser(element) {
        const url = process_env_url + '/edit/user/' + element.dataset.id;
        fetch(url,{
            method: "GET",
            headers: {
                'Content-type': 'application/json'
            },
        })
        .then(res => res.json())
        .then((data)=> {
            const user = new User(data.id,data.name,data.email,data.username,data.satker_id);
            $(UI.DOMStrings.modalEdit).modal({backdrop:'static'});
            document.querySelector('.modal-title').innerText = 'Edit User';
            UI.ambilData(user);
        })

    }

    /* Ambil data */

    static ambilData =  (data) => {
        document.querySelector('#id').value = data.id;
        document.querySelector('#edit_nama').value = data.nama;
        document.querySelector('#edit_satker').value = data.satker;
        document.querySelector('#edit_username').value = data.username;
        document.querySelector('#edit_email').value = data.email;
    }

    /* Delete User */

    static deleteUser(element) {
         const url = process_env_url + '/hapus/user/' + element.dataset.id;
         swal({
                 title: "Are you sure?",
                 text: "Ingin Menghapus? , anda akan kehilangan data User ini!",
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
                             $(UI.DOMStrings.tableUser).DataTable().ajax.reload();
                             swal({
                                 title: "Pesan!",
                                 text: data.message,
                                 icon: "success",
                             });
                         });
                 } else {
                     swal({
                         title: "Pesan!",
                         text: "anda telah membatalkan menghapus jenis radikalisme ",
                         icon: "success",
                     });
                 }
             });
    }

}

document.addEventListener("DOMContentLoaded",function(){
    UI.loadTable();

    /* UI SUBMIT TAMBAH  */
    const btnTambah = document.querySelector(UI.DOMStrings.btnTambah);
    btnTambah.addEventListener('click',function(event){
        event.preventDefault();
        UI.submitDataTambah();
    });

    /* UI SUBMIT EDIT */
     const btnEdit = document.querySelector(UI.DOMStrings.btnEdit);
     btnEdit.addEventListener('click', function (event) {
         event.preventDefault();
         UI.submitDataEdit();
     });


    /* UI EDIT DAN DELETE */
    const tbody = document.querySelector(UI.DOMStrings.Tbody);
    tbody.addEventListener('click',function(event){
         if (event.target.parentElement.classList.contains('btn-delete')) {
             UI.deleteUser(event.target.parentElement);
         } else if (event.target.parentElement.classList.contains('btn-edit')) {
             UI.editUser(event.target.parentElement);
         }
    })

});