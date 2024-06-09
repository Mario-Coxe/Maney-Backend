<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .main-head {
            height: 150px;
            background: #FFF;
        }

        .sidenav {
            height: 100%;
            background-color: #000;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .main {
            padding: 0px 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }
        }

        @media screen and (max-width: 450px) {
            .login-form {
                margin-top: 10%;
            }

            .register-form {
                margin-top: 10%;
            }
        }

        @media screen and (min-width: 768px) {
            .main {
                margin-left: 40%;
            }

            .sidenav {
                width: 40%;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
            }

            .login-form {
                margin-top: 80%;
            }

            .register-form {
                margin-top: 20%;
            }
        }

        .login-main-text {
            margin-top: 20%;
            padding: 60px;
            color: #fff;
        }

        .login-main-text h2 {
            font-weight: 300;
        }

        .btn-black {
            background-color: #000 !important;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="sidenav">
        <div class="login-main-text">
            <h2>Application<br> Login Page</h2>
            <p>Login from here to access.</p>
        </div>
    </div>
    <div class="main" id="app">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form @submit.prevent="login">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" v-model="phone" class="form-control" placeholder="Phone">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" v-model="password" class="form-control" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-black">Login</button>
                </form>
                <div v-if="msg.status" class="alert alert-danger mt-4" role="alert">
                    <strong v-text="msg.message"></strong>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                phone: '',
                password: '',
                msg: {
                    status: false,
                    message: ''
                }
            },
            methods: {
                async login() {
                    try {
                        const response = await axios.post('http://192.168.151.90:8080/api/v1/login', {
                            phone: this.phone,
                            password: this.password
                        });
                        if (response.status === 200 && response.data.data[0].tipo_usuario === 'agente') {
                            const token = response.data.token;
                            localStorage.setItem('token', token);
                            localStorage.setItem('user', JSON.stringify(response.data.data[0]));
                            location.href = '/agent/dashboard';
                        } else {
                            this.msg.status = true;
                            this.msg.message = "Sem premissão de acesso";
                        }
                    } catch (error) {
                        if (error.response && error.response.status === 401) {
                            this.msg.status = true;
                            this.msg.message = error.response.data.msg;
                        } else {
                            this.msg.status = true;
                            this.msg.message = 'Erro ao tentar fazer login.';
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>