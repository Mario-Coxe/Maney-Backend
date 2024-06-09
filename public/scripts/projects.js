import * as vue from "../_/vue.js"
import {configs} from "./config.js"

        var app = new Vue({
            el:"#app",
            data:{
                comment:'',
                categorias:[],
                projectos:[],
                newproject:[],
                newpr:{
                    nif:'',
                    categoria:1,
                },
                 pemandamento:0,
                dis:0,
                lol:0,
                editproject:{
                    titulo:'',
                    descricao:'',
                    categoria:'',
                    data:'',
                    id:''
                },
                notificacoes:[],
                eu:JSON.parse(localStorage.getItem('usuario_bumbeiros')),
                double:'',
                tipo_de_pagamento:[],
                filtro:"todos",


            },
            methods:{
                
            filtrar(){
                
                if(this.filtro == "novos"){
                    var dd = [];
                    this.projectos.forEach(function(item,index){
                       if(item.status == "available"){
                            dd[index] = {
                                     "categories_id":"item.categories_id",
                                     "chat_id":item.chat_id,
                                     "created_at":item.created_at,
                                     "delivery_date":item.delivery_date,
                                     "id":item.id,
                                     "image":item.image,
                                     "p_description":item.p_description,
                                     "p_title":item.p_title,
                                     "status":item.status,
                                     "tipo_de_pagamento":item.tipo_de_pagamento,
                                     "updated_at":item.updated_at,
                                     "user_id":item.user_id,
                                     
                                 };
                             }
                             
                             
                       });
                       this.projectos = dd.filter(n=>n);
                       
                    }else if(this.filtro == "emandamento"){
                        this.getprojects();
                        
                        setTimeout(function(){
                           var dd = [];
                            app.projectos.forEach(function(item,index){
                           if(item.status == "progress"){
                                dd[index] = {
                                         "categories_id":"item.categories_id",
                                         "chat_id":item.chat_id,
                                         "created_at":item.created_at,
                                         "delivery_date":item.delivery_date,
                                         "id":item.id,
                                         "image":item.image,
                                         "p_description":item.p_description,
                                         "p_title":item.p_title,
                                         "status":item.status,
                                         "tipo_de_pagamento":item.tipo_de_pagamento,
                                         "updated_at":item.updated_at,
                                         "user_id":item.user_id,
                                         
                                     };
                                 }
                             
                             
                       });
                       app.projectos = dd.filter(n=>n);
                        }, 500);
                       
                        
                    }else if (this.filtro == "porfinalizar"){
                        
                       this.getprojects();
                        
                        setTimeout(function(){
                           var dd = [];
                            app.projectos.forEach(function(item,index){
                           if(item.status == "pre-finished"){
                                dd[index] = {
                                         "categories_id":"item.categories_id",
                                         "chat_id":item.chat_id,
                                         "created_at":item.created_at,
                                         "delivery_date":item.delivery_date,
                                         "id":item.id,
                                         "image":item.image,
                                         "p_description":item.p_description,
                                         "p_title":item.p_title,
                                         "status":item.status,
                                         "tipo_de_pagamento":item.tipo_de_pagamento,
                                         "updated_at":item.updated_at,
                                         "user_id":item.user_id,
                                         
                                     };
                                 }
                             
                             
                       });
                       app.projectos = dd.filter(n=>n);
                        }, 500);
                        
                    }else if(this.filtro =="finalizados"){
                        
                        this.getprojects();
                        
                        setTimeout(function(){
                           var dd = [];
                            app.projectos.forEach(function(item,index){
                           if(item.status == "finished"){
                                dd[index] = {
                                         "categories_id":"item.categories_id",
                                         "chat_id":item.chat_id,
                                         "created_at":item.created_at,
                                         "delivery_date":item.delivery_date,
                                         "id":item.id,
                                         "image":item.image,
                                         "p_description":item.p_description,
                                         "p_title":item.p_title,
                                         "status":item.status,
                                         "tipo_de_pagamento":item.tipo_de_pagamento,
                                         "updated_at":item.updated_at,
                                         "user_id":item.user_id,
                                         
                                     };
                                 }
                             
                             
                       });
                       app.projectos = dd.filter(n=>n);
                        }, 500);
                        
                    }else if (this.filtro == "todos"){
                        this.getprojects();
                    }
                }
            ,
                
            async concluir(id){


                var bodyFormData = new FormData();
                bodyFormData.append("projectid",id);

                await axios({
                    method: 'post',
                    url: configs.urlbase+'projecto/concluir',
                    data: bodyFormData,
                    headers: configs.headersform,
                }).then((response)=>{

                    if(response.status == 200){
                        this.chamartoast('Projecto Concluido com sucesso');
                        location.reload();
                    }
                });

            },
                
                getPaymentsType(){
                    axios.get("http://135.181.43.100:3400/api/tipos-de-pagamentos").then((response)=>{
                        this.tipo_de_pagamento = response.data['metodos-de-pagamentos'];
                        
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


                isdouble(){

                    axios({
                        method: 'post',
                        url: configs.urlbase+'usuario/doubleaccount',
                        headers: configs.headersform,
                    }).then((response)=>{
                        this.double = response.data.isdouble;
                    });
                },

               /* async upgrade(){
                    var bodyFormData = new FormData();
                    bodyFormData.append("categoire",this.newpr.categoria);
                    bodyFormData.append("nif",this.newpr.nif);

                    await axios({
                        method: 'post',
                        url: configs.headers+'usuario/atualizar-conta/profissional',
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

                },*/


                editar(projecto){
                    $('#editar').modal('show');
                    this.editproject.titulo = projecto.p_title;
                    this.editproject.descricao = projecto.p_description;
                    this.editproject.categoria = projecto.categories_id;
                    this.editproject.data = projecto.delivery_date;
                    this.editproject.id = projecto.id;
                },

                async salvar(id){

                   var bodyFormData = new FormData();
                    bodyFormData.append("project_title",this.editproject.titulo);
                    bodyFormData.append("project_description",this.editproject.descricao);
                    bodyFormData.append("delivery_date",this.editproject.data);
                    bodyFormData.append("categories_id",this.editproject.categoria);

                    await axios({
                        method: 'post',
                        url: configs.urlbase+'projecto/editar/'+id,
                        data: bodyFormData,
                        headers: configs.headersform,
                    }).then((response)=>{
                        if(response.status == 200){
                            this.chamartoast('Projecto editado com sucesso');

                        }
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
                            this.chamartoast('Projecto Criado com sucesso!!');

                        }
                    });

                },
                
            async cp(){
                var count=0;
                var dis = 0;
                var lol =0;
                await axios.get(configs.urlbase+'usuario/meus-projectos',configs.headers).then((response)=>{
                    response.data['projectos'].forEach(function(item,index){
                        if(item.status == "progress" || item.status == 'pre-finished'){
                            count++;
                        }else if(item.status == 'available'){
                            dis++;
                        }else if(item.status == 'finished'){
                            lol++
                        }
                    });

                }).catch(error=>{
                	console.log(error)
                })
                this.pemandamento = count;
                this.dis = dis;
                this.lol = lol;
            },

                chamartoast(msg){

                    $('#criar').modal('hide');
                    $('#editar').modal('hide');

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

                async upgrade(){
                    var bodyFormData = new FormData();
                    bodyFormData.append("categoire",this.newpr.categoria);
                    bodyFormData.append("nif",this.newpr.nif);
    
                    await axios({
                        method: 'post',
                        url: 'http://135.181.43.100:3400/api/usuario/atualizar-conta/profissional',
                        data: bodyFormData,
                        headers: {
                            Authorization: "Bearer " + localStorage.getItem('bumbeiros_jwt'),
                            'Content-Type': `multipart/form-data`
                        },
                    }).then((response)=>{
                        // console.log(response)
                        this.chamartoast(response.data.message);
                        if(response.data.status == true){
                            localStorage.setItem('account_type', 'profissional');
                            location.href = 'htttp://bumbeiros-beta.com/profissional/'
                        }
                    });
    
                },

                async getprojects(){
                    await axios.get(configs.urlbase+'usuario/meus-projectos',configs.headers).then(
                        (response)=>{
                            if(response.status ==200){
                                this.projectos = response.data['projectos'];

                               /* setTimeout(function(){
                                    $('#zero-config').DataTable({
                                        "oLanguage": {
                                            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                                            "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                                            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                                            "sSearchPlaceholder": "Procurar...",
                                            "sLengthMenu": "Resultados :  _MENU_",
                                        },
                                        "stripeClasses": [],
                                        "lengthMenu": [7, 10, 20, 50],
                                        "pageLength": 7
                                    });
                                },1000);*/
                            }
                        }
                    )
                },
                getNotifications (){
                    axios.get(configs.urlbase+'usuario/minhas-notificacoes',configs.headers).then((response)=>{
                        this.notificacoes = response.data.notifications;
                    });
                },
            },
            mounted(){
                this.isdouble(),
                this.cp(),
                this.getprojects();
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


            }
        });