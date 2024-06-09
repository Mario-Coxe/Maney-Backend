import * as vue from '../_/vue.js'
import {configs} from './config.js'

var app = new Vue({
    el:'#app',
        data:{
            comment:'',
            me:[],
            newproject:[],
            categorias:[],
            endereco:[],
            newdata:[],
            notificacoes:[],
            eu:JSON.parse(localStorage.getItem('usuario_bumbeiros')),
            senha:[],
            newpr:{
                nif:'',
                categoria:1,
            },
            double:'',
            categoria:"",
            tipo_de_pagamento:"",



        },
        methods:{

            async atualizarEndereco(){
                const URL = configs.urlbase+'usuario/atualizar-endereco';

                axios({
                    url:URL,
                    method:"POST",
                    data:{endereco:this.endereco},
                    headers: configs.headers.headers,
                }).then(response=>{
                    if(response.data.status == true){
                        this.chamartoast(response.data.message);
                    }
                }).catch(error=>{
                    alert(error.data.message);
                });
            },

            async carregarfoto(event){
                
                const URL = configs.urlbase+'usuario/nova-foto'; 
                let data = new FormData();
                data.append('pic', 'my-picture');
                data.append('image', event.target.files[0]); 

                let config = {
                  headers : {
                    'Content-Type' : 'image/png',
                     'Authorization': "Bearer " + localStorage.getItem('bumbeiros_jwt')
                  }
                }

                axios.post(
                      URL, 
                      data,
                      config
                    ).then(
                      response => {
                        if (response.status == 201) {
                            this.chamartoast(response.data.message,1000);
                        }
                      }
                    )
                  }

            ,

            async avaliar(){

                axios({
                    method: 'post',
                    url: configs.urlbase+'usuario/comentar',
                    data: {avaliacao:this.comment},
                    headers: configs.headers.headers
                }).then((response)=>{
                    if(response.status == 201){
                        this.chamartoast(response.data.message);
                    }
                })
            },

            isdouble(){

                axios({
                    method: 'post',
                    url: configs.urlbase+'usuario/doubleaccount',
                    headers: configs.headersform,
                }).then((response)=>{
                    this.double = response.data.isdouble;
                });
            },


            async upgrade(){
                var bodyFormData = new FormData();
                bodyFormData.append("categoire",this.newpr.categoria);
                bodyFormData.append("nif",this.newpr.nif);

                await axios({
                    method: 'post',
                    url: configs.urlbase+'usuario/atualizar-conta/profissional',
                    data: bodyFormData,
                    headers: configs.headersform,
                }).then((response)=>{
                    this.chamartoast(response.data.message);
                    if(response.data.status == true){
                        localStorage.setItem('account_type', 'profissional');
                        location.href = 'http://135.181.43.100:3400/profissional/'
                    }
                });

            },

            verificarsenha(){
                console.log('Ola');
                if(this.senha.p1 != this.senha.p2){
                    document.getElementById('btnSenha').setAttribute('disabled','disabled');
                    document.getElementById('error-msg').removeAttribute('hidden')
                }else{
                    document.getElementById('btnSenha').removeAttribute('disabled');
                    document.getElementById('error-msg').setAttribute('hidden','hidden');
                }
            },



            updateProfile(){
                var bodyFormData = new FormData();
                var fname = this.me.nome.split(" ")[0];
                var lname = this.me.nome.split(" ")[1];

                bodyFormData.append("fname",fname);
                bodyFormData.append("lname",lname);
                bodyFormData.append("email",this.me.email);
                bodyFormData.append("phone",this.me.telefone);

                axios({
                    method: 'post',
                    url: configs.urlbase+'usuario/atualizar-perfil',
                    data: bodyFormData,
                    headers: configs.headersform,
                }).then((response) => {
                    if (response.status == 200) {
                        this.chamartoast('Dados Actualizados!!')
                        this.meuPerfil();



                    } else {

                    }
                })
            },



            async saveproject(){

                var bodyFormData = new FormData();
                bodyFormData.append("poject_title",this.newproject.titulo);
                bodyFormData.append("project_description",this.newproject.descricao);
                bodyFormData.append("delivery_date",this.newproject.data);
                bodyFormData.append("categories_id",this.newproject.categoria);
                bodyFormData.append("tipo_de_pagamento",this.newproject.pagamento);

                //console.log(bodyFormData);

                await axios({
                    method: 'post',
                    url: configs.urlbase+'projecto/criar',
                    data: bodyFormData,
                    headers: configs.headersform,
                }).then((response)=>{
                    if(response.status == 201){
                        this.chamartoast("Projecto criado");
                    }
                });

            },

            getPaymentsType(){
            axios.get(configs.urlbase+"tipos-de-pagamentos").then((response)=>{
                this.tipo_de_pagamento = response.data['metodos-de-pagamentos'];
                        
                })
            },

            chamartoast(data,seconds =1000){
                $('#criar').modal('hide');
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    type: 'success',
                    title: data,
                    padding: '2em',
                });

                setTimeout(function(){
                    location.reload();
                },seconds)
            },


          async  atualizarsenha(){

              var bodyFormData = new FormData();
              bodyFormData.append("senha",this.senha.p1);
              bodyFormData.append("senhatual",this.senha.atual);

                 await axios({
                    method: 'post',
                    url: configs.urlbase+'usuario/atualizar-senha',
                    data: bodyFormData,
                    headers: configs.headersform,
                }).then((response)=>{
                    if(response.status == 200){
                        this.chamartoast("Senha Atualizada com sucesso");
                    }
                });
            },


            async getcategorias(){
                await axios.get(configs.urlbase+'categorias').then(
                    (response)=>{
                        if(response.status ==200){
                            this.categorias = response.data['categorias'];
                            // console.log(this.categorias)
                        }
                    })
            },

             meuPerfil(){

                 axios.get(configs.urlbase+'usuario/perfil',configs.headers).then((response)=>{
                    this.endereco = response.data['endereco'][0];
                    this.newdata = response.data['user'];
                    //this.categoria = response.data['categoria'];

                     let usuario = {
                         "id": this.newdata.id,
                         "nome": this.newdata.fname + " " + this.newdata.lname,
                         "email": this.newdata.email,
                         "telefone": this.newdata.phone,
                         "foto":this.newdata.image_profile,
                     }
                     localStorage.removeItem('usuario_bumbeiros');
                     window.localStorage.setItem('usuario_bumbeiros', JSON.stringify(usuario));
                })
            },

            getNotifications (){
                axios.get(configs.urlbase+'usuario/minhas-notificacoes',configs.headers).then((response)=>{
                    this.notificacoes = response.data.notifications;
                });
            },

        },


        mounted(){
            this.getPaymentsType();
            this.isdouble();
            this.getcategorias()
            this.me = JSON.parse(localStorage.getItem('usuario_bumbeiros'));
            this.meuPerfil();
            this.getNotifications();

            /*Echo.private(`userNotification.${this.eu.id}`).listen('.ShowNotification', (e)=>{
                this.notificacoes.push(e.notification)
                Snackbar.show({
                    text: e.notification.description,
                    duration: 20000,
                    showAction: false,
                    pos: 'bottom-right',
                    actionTextColor: '#fff',
                    backgroundColor: '#2196f3'
                });
            })*/
        }
});
