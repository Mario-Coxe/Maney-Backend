var SessionTimeout=function() {
    var e=function() {
        $.sessionTimeout( {
            title:"Session Timeout Notification", 
            message:"Sua sessão terminou", 
            keepAliveUrl:"", 
            redirUrl:"auth_lockscreen.html", 
            logoutUrl:"auth_login.html", 
            warnAfter:6000, 
            redirAfter:localStorage.getItem('exp'), 
            ignoreUserActivity:!0, 
            countdownMessage:"Terminando em {timer}.", 
            countdownBar: !0
        }
        )
    };
    return {
        init:function() {
            e()
        }
    }
}

();
jQuery(document).ready(function() {
    SessionTimeout.init()
}
);