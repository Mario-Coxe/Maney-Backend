import * as vue from '../../_/vue.js'
import {configs} from '../config.js'


var app = new Vue({
    el:'#app',
    data:{
        contacto:"",
        msg:{
            status:false,
            message:"message"
        },
        senha:{
            p1:"",
            p2:"",
        }
    },
    methods:{

        async enviar(){
           if(this.contacto.length >= 9){
               if(this.contacto.includes("244")){
                   this.msg.status = "true";
                   this.msg.message = "remova o indicativo para continuar";
                   return false;
               }else{
                this.msg.status = false;
               }
               await axios.post(configs.urlbase+"admin/recuperar",{contacto:this.contacto}).then((response=>{
                    this.msg.status = true;
                    this.msg.message = response.data.message;
               })).catch((err)=>{
                   this.msg.status = true;
                   this.msg.message = err.response.data.message;
               });

               return true;
               
           }
        },

        repor(){
            if(this.senha.p1.length <= 7){
                this.msg.status = "true";
                this.msg.message = "Sua senha precisa de 8 ou mais digitos";
            }else{
                this.msg.status = false;

                if(this.senha.p1 != this.senha.p2){
                    this.msg.status = "true";
                    this.msg.message = "Suas senhas não coincidem!";
                    return false;
                }

                var code = location.href.split("/")[5];

                axios.post(configs.urlbase+"admin/reset",{code:code,senha:this.senha.p1}).then((response)=>{
                    this.msg.status = "true";
                    this.msg.message = response.data.message;
                    setTimeout(() => {
                        location.href="http://135.181.43.100:3400/administrador/"
                    }, 1000);
                    return false;
                }).catch((err)=>{
                    console.log(err.response.data)
                });

            }

        }
    },
});