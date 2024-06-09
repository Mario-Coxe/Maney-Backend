import * as vue from '../_/vue.js'
import {configs} from './config.js'
var app = new Vue({
        el:"#app",
        data:{
            chats:[],
            newproject:[],
            newpr:{
                nif:'',
                categoria:1,
            },
            mensagens:[],
            detalhes:[],
            avaliacao:[],
            dd:'',
            eu:JSON.parse(localStorage.getItem('usuario_bumbeiros')),
            chatu:'',
            conversa:[],
            notificacoes:[],
            double:'',
            categorias:[],
            tipo_de_pagamento:[],
            comment:"",



        },
        methods:{
            
            topr(){
                var url = location.href.split("=");
                if(url.length == 2){
                setTimeout(function(){
                    app.abrir_chat(url[1]);
                },1500)
            }
        },

            async getcategorias(){
                await axios.get(configs.urlbase+'categorias').then(
                    (response)=>{
                        if(response.status ==200){
                            this.categorias = response.data['categorias'];
                            // //console.log(this.categorias)
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
                    // //console.log(response)
                    this.chamartoast(response.data.message);
                    if(response.data.status == true){
                        localStorage.setItem('account_type', 'profissional');
                        location.href = 'htttp://bumbeiros-beta.com/profissional/'
                    }
                });

            },

            async getchats(){
                axios.get(configs.urlbase+'mensagens/todas-mensagens',configs.headers).then((response=>{
                    this.chats = response.data.mensagens;
                    //console.log(this.chats)
                }));
            },

            async loadChats(id){
                this.chatu = id;
                await axios.get(configs.urlbase+'mensagens/ver/'+id,configs.headers).then((response=>{
                    this.mensagens = response.data.mensagens;
                    this.detalhes = response.data.detalhes;
                    this.dd = this.detalhes['NomeDoProjecto'];
                    response.data.mensagens[0]['recipient_id'] == this.eu.id ? this.conversa.recipient_id = response.data.mensagens[0]['sender_id'] : this.conversa.sender_id = response.data.mensagens[0]['recipient_id'];

                }));
            },

            chamartoast(data){
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
                },1000)
            },

            async terminarprojecto(){


                var bodyFormData = new FormData();
                bodyFormData.append("projectid",this.detalhes.ProjectId);

                await axios({
                    method: 'post',
                    url: configs.urlbase+'projecto/concluir',
                    data: bodyFormData,
                    headers: configs.headersform,
                }).then((response)=>{
                    //console.log(response.data);
                    if(response.status == 200){
                        this.chamartoast('Projecto Concluido com sucesso');
                        location.reload();
                    }
                });

            },

            async avaliar(){

                //console.log(this.avaliacao);

                var bodyFormData = new FormData();
                bodyFormData.append("stars",this.avaliacao.estrelas);
                bodyFormData.append("rating",this.avaliacao.comment);
                bodyFormData.append("project_id",this.detalhes.ProjectId);

                await axios({
                    method: 'post',
                    url: configs.urlbase+'projecto/avaliar',
                    data: bodyFormData,
                    headers: configs.headersform,
                }).then((response)=>{
                    //console.log(response.data);
                    if(response.status == 200){
                        this.chamartoast(response.data.message);
                        setTimeout(function(){
                            location.reload();
                        },1000);
                    }
                });

            },


            aceitar(){


                var bodyFormData = new FormData();
                bodyFormData.append("proposal_id",this.detalhes.PropostaId);


                axios({
                    url: configs.urlbase+'proposta/aceitar',
                    method: 'post',
                    data: bodyFormData,
                    headers: configs.headersform,

                }).then((response)=>{
                    if(response.status == 200){
                        this.detalhes.Estado = 'aceite';
                        this.chamartoast('Proposta aceite com sucesso!!');

                    }
                })
            },

            recusar(){


                var bodyFormData = new FormData();
                bodyFormData.append("proposal_id",this.detalhes.PropostaId);


                axios({
                    url: configs.urlbase+'proposta/negar',
                    method: 'post',
                    data: bodyFormData,
                    headers: configs.headersform,

                }).then((response)=>{
                    if(response.status == 200){
                        this.detalhes.Estado = 'recusado';
                    }
                })
            },

            mostrar(){
                $(".hamburger, .chat-system .chat-box .chat-not-selected p").parents('.chat-system').find('.user-list-box').toggleClass('user-list-box-show')
            },
            enviarmensagem(){
                var bodyFormData = new FormData();
                bodyFormData.append("message",this.conversa.mensagem);

                axios({
                    method: 'post',
                    url: configs.urlbase+'mensagens/enviar-mensagem/'+this.chatu,
                    data: bodyFormData,
                    headers: configs.headersform,
                }).then((response)=>{
                    var messageHtml = '<div class="bubble me">' + this.conversa.mensagem + '</div>';
                    var appendMessage = $(".mail-write-box").parents('.chat-system').find('.active-chat').append(messageHtml);
                    const getScrollContainer = document.querySelector('.chat-conversation-box');
                    getScrollContainer.scrollTop = getScrollContainer.scrollHeight;
                    this.conversa.mensagem = ''
                }).catch(error=>{
                    alert(error.data);
                })
            },

            descer:function(){
                if(this.mensagens.length){
                    document.querySelector('.bubble:last-child').scrollIntoView();
                }
            },

            abrir_chat(id){
                this.loadChats(id);
                if ($("#"+id).hasClass('.active')) {
                    return false;
                } else {
                    var findChat = $("#"+id).attr('data-chat');
                    var personName = $("#"+id).find('.user-name').text();
                    var personImage = $("#"+id).find('img').attr('src');
                    var hideTheNonSelectedContent = $("#"+id).parents('.chat-system').find('.chat-box .chat-not-selected').hide();
                    var showChatInnerContent = $("#"+id).parents('.chat-system').find('.chat-box .chat-box-inner').show();

                    if (window.innerWidth <= 767) {
                        $('.chat-box .current-chat-user-name .name').html(personName.split(' ')[0]);
                    } else if (window.innerWidth > 767) {
                        $('.chat-box .current-chat-user-name .name').html(personName);
                    }
                    $('.chat-box .current-chat-user-name img').attr('src', personImage);
                    $('.chat').removeClass('active-chat');
                    $('.user-list-box .person').removeClass('active');
                    $('.chat-box .chat-box-inner').css('height', '100%');
                    $("#"+id).addClass('active');
                    $('.chat[data-chat = '+findChat+']').addClass('active-chat');
                }
                if ($("#"+id).parents('.user-list-box').hasClass('user-list-box-show')) {
                    $("#"+id).parents('.user-list-box').removeClass('user-list-box-show');
                }
                $('.chat-meta-user').addClass('chat-active');
                $('.chat-box').css('height', 'calc(100vh - 233px)');
                $('.chat-footer').addClass('chat-active');

                const ps = new PerfectScrollbar('.chat-conversation-box', {
                    suppressScrollX : true
                });

                const getScrollContainer = document.querySelector('.chat-conversation-box');
                getScrollContainer.scrollTop = 0;
            },

            getNotifications (){

                axios.get(configs.urlbase+'usuario/minhas-notificacoes',configs.headers).then((response)=>{
                    this.notificacoes = response.data.notifications;
                });
            },

        },
        mounted(){
            this.topr();
            //this.isdouble();
            this.getNotifications();
            this.getchats();
            this.getcategorias();
            /*Echo.private(`user.${this.eu.id}`).listen('.SendMessage',async (e)=>{
                if(this.chatu == e.message.chat_id){
                    await this.mensagens.push(e.message);
                    document.querySelector('.chat-conversation-box').scrollTop = document.querySelector('.chat-conversation-box').scrollHeight
                }

            });*/

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