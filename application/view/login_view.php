<br><br>
<div class="section container center-align z-depth-5 animated bounceInDown" id="p1">
    <form method="POST" action="/login/validarUser">  
        <div class="row">
            <div class="col s6 offset-s3">
                <h4 class="white-text center-align">Login</h4>
                <i class="fas fa-user fa-3x white-text center-align"></i>
            </div>
        </div>
        <div class="row">
            <div class="col s1"></div>
            <div class="col s1 center-align">
                <i class="far fa-envelope fa-2x white-text"id="xd" ></i>
            </div>
            <div class="col s1"></div>
            <div class="input-field col s6">
              <input id="email" type="email" class="validate white-text" name="user">
              <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="col s1"></div>
                <div class="col s1 center-align">
                <i class="fas fa-unlock-alt fa-2x white-text"id="xd"></i>
                </div>
                <div class="col s1"></div>
                <div class="input-field col s6">
                  <input id="password" type="password" class="validate white-text" name="pass">
                  <label for="password">Password</label>
                </div>
        </div>
        <div class="row">
        <div class="col s10 offset-s1">
        <button class="waves-effect waves-light btn-large orange darken-4" type="submit" name="submit">Login</button> 
        </div>

        </div>
        <br>
        <div class="row">   
        <h5><div class="input-field col s6 offset-s3"><a href="/registro"><h5>Registrarse</h5></a></div>
        </div>
        <?php
        if(isset($data)){
        	echo '<div>
            <h5><span class="white-text text-darken-4">'.$data.'</span></h5>
          </div>';
        }?>  
    </form>
</div>
<br><br><br><br><br><br>
<style>
#p1{
    background-color:rgba(0,0,0,0.9);
    width:50%;
    padding:4px;
    /* margin: auto; */
    }

#xd{
    margin-top:30px;
}
@-webkit-keyframes autofill {
    to {
        color: #FFF;
        background: transparent;
    }
}

input:-webkit-autofill {
    -webkit-animation-name: autofill;
    -webkit-animation-fill-mode: both;
}
</style>