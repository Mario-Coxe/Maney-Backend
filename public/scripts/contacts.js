import * as vue from '../_/vue.js'
import {configs} from './config.js'
var app = new Vue({
            el:"#app",
            data:{
                comment:'',
                profissionais:[],
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
                
                getPaymentsType(){
                    axios.get(configs.urlbase+"tipos-de-pagamentos").then((response)=>{
                        this.tipo_de_pagamento = response.data['metodos-de-pagamentos'];  
                    })
                },
                async avaliar(){
                    axios({
                        method: 'post',
                        url: configs.urlbase+'usuario/comentar',
                        data: {avaliacao:this.comment},
                        headers: configs.headers
                    }).then((response)=>{
                        if(response.status == 201){
                            this.chamartoast(response.data.message);
                            setTimeout(function(){
                                location.reload();
                            },1000)
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
                        headers: {
                            Authorization: "Bearer " + localStorage.getItem('bumbeiros_jwt'),
                            'Content-Type': `multipart/form-data`
                        },
                    }).then((response)=>{
                        this.chamartoast(response.data.message);
                        if(response.data.status == true){
                            localStorage.setItem('account_type', 'profissional');
                            location.href = 'http://135.181.43.100:3400/profissional/'
                        }
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
                            this.chamartoast("Projecto Criado");
                        }
                    });
                },
                chamartoast(msg){
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
                        title: msg,
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
                async getprofissionais(){
                    await axios.get(configs.urlbase+'todos-profissionais').then((response)=>{
                        this.profissionais = response.data['profissionais'];
                    })
                },
                getNotifications (){
                    axios.get(configs.urlbase+'usuario/minhas-notificacoes',configs.headers).then((response)=>{
                        this.notificacoes = response.data.notifications;
                    });
                },
                buscar(){
                	 $('#input-search').on('keyup', function() {
					   var rex = new RegExp($(this).val(), 'i');
					     $('.searchable-items .items:not(.items-header-section)').hide();
					     $('.searchable-items .items:not(.items-header-section)').filter(function() {
					         return rex.test($(this).text());
					     }).show();
					 });
                }
            },
            mounted(){
                this.isdouble();
                this.getNotifications();
                this.getprofissionais();
                this.getcategorias();
                this.getPaymentsType();
               /* Echo.private(`userNotification.${this.eu.id}`).listen('.ShowNotification', (e)=>{
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