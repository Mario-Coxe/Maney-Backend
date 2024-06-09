import * as vue from '../_/vue.js'
import {configs} from './config.js'


$(document).on("click", ".idpagamento", function () {
    var idpagamento = $(this).attr('id-pagamento');
    app._data.id = idpagamento;
})

var app = new Vue({
        el:'#app',
        data:{
            id:0,
            comment:'',
            pagamentos:[],
            newproject:[],
            categorias:[],
            notificacoes:[],
            eu:JSON.parse(localStorage.getItem('usuario_bumbeiros')),
            newpr:{
                nif:'',
                categoria:1,
            },
            double:'',
            tipo_de_pagamento:"",


        },
        methods:{

            async upload(){

                let data = new FormData();
                data.append('file', document.getElementById('pdf').files[0]);
                //console.log(this.id)
                data.append('id', this.id);

                axios({
                    method:'post',
                    url: configs.urlbase+'usuario/carregar-comprovativo',
                    data:data,
                    headers: configs.headersform,

                }).then((response)=>{
                    if(response.status == 201){
                        //console.log()
                       this.chamartoast(response.data[0].message);
                    }else{
                        alert("Aconteceu um erro");
                    }
                }).catch(error=>{
                	alert("Aconteceu um erro")
                })
            },

            async avaliar(){

                axios({
                    method: 'post',
                    url: configs.urlbase+'usuario/comentar',
                    data: {avaliacao:this.comment},
                    headers: {
                        Authorization: "Bearer " + localStorage.getItem('bumbeiros_jwt'),
                    },
                }).then((response)=>{
                    if(response.status == 201){
                        this.chamartoast(response.data.message);
                    }
                })
            },

            getPaymentsType(){
            axios.get(configs.urlbase+"tipos-de-pagamentos").then((response)=>{
                this.tipo_de_pagamento = response.data['metodos-de-pagamentos'];
                        
                })
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
                    // console.log(response)
                    this.chamartoast(response.data.message);
                    if(response.data.status == true){
                        localStorage.setItem('account_type', 'profissional');
                        location.href = 'htttp://bumbeiros-beta.com/profissional/'
                    }
                });

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
            chamartoast(message){
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
                    title: message,
                    padding: '2em',
                });

                setTimeout(function(){
                    location.reload();
                },1000)
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
            
                getPaymentsType(){
                    axios.get(configs.urlbase+"tipos-de-pagamentos").then((response)=>{
                        this.tipo_de_pagamento = response.data['metodos-de-pagamentos'];
                        
                    })
                },
            async getPayments(){
                await axios.get(configs.urlbase+'usuario/meus-pagamentos',configs.headers).then((response)=>{
                    this.pagamentos = response.data['meus-pagamentos'];
                    setTimeout(function (){
                        $('#zero-config').DataTable({
                            "oLanguage": {
                                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                                "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                                "sSearchPlaceholder": "Procurar...",
                                "sLengthMenu": "Resultados :  _MENU_",
                            },
                            "stripeClasses": [],
                            "lengthMenu": [5, 10, 20, 40],
                            "pageLength": 5
                        });
                    },10)
                })
            },

            getNotifications (){

                axios.get(configs.urlbase+'usuario/minhas-notificacoes',configs.headers).then((response)=>{
                    this.notificacoes = response.data.notifications;
                });
            },
        },
        mounted(){
            this.isdouble();
            this.getcategorias();
            this.getPayments();
            this.getNotifications();
            this.getPaymentsType();
            this.getPaymentsType();

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
    })