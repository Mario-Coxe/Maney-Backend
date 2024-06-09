import * as vue from '../_/vue.js'
import {configs} from './config.js'
var app = new Vue({
        el:'#app',
        data:{
            comment:'',
            newpr:{
                nif:'',
                categoria:1,
            },
            newproject:[],
            categorias:[],
            eu:JSON.parse(localStorage.getItem('usuario_bumbeiros')),
            notificacoes:'',
            double:'',
            ticket:{
                problem:'Não consigo trocar de conta',
                description:'',
                contact_form:'telefone',
            },
            tipo_de_pagamento:"",
        },
        methods:{
            
                getPaymentsType(){
                    axios.get(configs.urlbase+"tipos-de-pagamentos").then((response)=>{
                        this.tipo_de_pagamento = response.data['metodos-de-pagamentos'];
                        
                    })
                },

            async saveticket(){

                await axios({
                    method: 'post',
                    url: configs.urlbase+'usuario/reportar',
                    data: {problem:this.ticket.problem,description:this.ticket.description,contact_form: this.ticket.contact_form},
                    headers: configs.headers.headers,
                }).then((response)=>{
                    console.log(response.data);
                    if(response.status == 201){
                        this.chamartoast(response.data.message);
                        setTimeout(function(){
                            location.reload();
                        },200);
                    }
                });


            },
            
            async avaliar(){

                axios({
                    method: 'post',
                    url: configs.urlbase+'usuario/comentar',
                    data: {avaliacao:this.comment},
                    headers: configs.headers.headers,
                }).then((response)=>{
                    if(response.status == 201){
                        this.chamartoast(response.data.message);
                    }
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
                    headers:configs.headersform,
                }).then((response)=>{
                    // console.log(response)
                    this.chamartoast(response.data.message);
                    if(response.data.status == true){
                        localStorage.setItem('account_type', 'profissional');
                        location.href = 'htttp://bumbeiros-beta.com/profissional/'
                    }
                });

            },

            async saveproject(){

                var bodyFormData = new FormData();
                bodyFormData.append("poject_title",this.newproject.titulo);
                bodyFormData.append("project_description",this.newproject.descricao);
                bodyFormData.append("delivery_date",this.newproject.data);
                bodyFormData.append("categories_id",this.newproject.categoria);

                await axios({
                    method: 'post',
                    url: configs.urlbase+'projecto/criar',
                    data: bodyFormData,
                    headers: configs.headersform,
                }).then((response)=>{
                    if(response.status == 201){
                        this.chamartoast('Projecto Criado com Sucesso!!');
                    }
                });

            },

            async alterar(){

                await axios({
                    method: 'POST',
                    url: configs.urlbase+'usuario/mudar-conta',
                    headers: configs.headersform,
                }).then((response)=>{
                    if(response.data.status == true){
                        this.chamartoast(response.data.message)
                        // localStorage.setItem('account_type', 'profissional');
                        //location.href = 'htttp://bumbeiros-beta.com/profissional/'
                        setTimeout(function(){
                            sair();
                        },300)


                    }
                });
            },

            chamartoast(e){
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
                    title: e,
                    padding: '2em',
                });
            },


            async getcategorias(){
                await axios.get(configs.urlbase+'categorias').then(
                    (response)=>{
                        if(response.status ==200){
                            this.categorias = response.data['categorias'];
                        }
                    })
            },

            getNotifications (){

                axios.get(configs.urlbase+'usuario/minhas-notificacoes',configs.headers).then((response)=>{
                    this.notificacoes = response.data.notifications;
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
            }
        },

        mounted(){
            this.isdouble();
            this.getcategorias();
            this.getNotifications();
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
        },
    })