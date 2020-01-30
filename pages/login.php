<div id="fb-root"></div>
<div class="container my-5" ng-controller="loginCtrl">
    <div class="tab rounded-top">
        <button class="col-6 tablinks" onclick="openTabs(event, 'login')" id="defaultOpen">Log ind</button>
        <button class="col-6 tablinks" onclick="openTabs(event, 'new')">Oprettelse</button>
    </div>

    <div id="login" class="tabcontent rounded-bottom">
        <div class="col-12 pb-5 admin-border">
            <div class="mt-3 mb-3 page-header">
                <h3>Log ind med din email eller Facebook</h4>      
            </div>
            <form ng-submit="logonEmail()">
                <label for="login_email">Email</label>
                <input type="email" class="form-control" id="login_email" placeholder="Din email" ng-model="email" required>
                <label for="login_password">Password</label>
                <input type="password" class="form-control" id="login_password" placeholder="Password" ng-model="password" required>
                <button type="submit" class="btn btn-primary mt-3">Log ind med email</button>
            </form>
            <div class="alert-danger mt-3 center">
                {{server_msg}}
            </div>
            <div class="col-12 eller-box">	
                <div class="eller">eller</div>
            </div>

            <!-- FACEBOOK LOGIN -->			
            
            <button ng-click="logonFacebook()" class="btn-fb">Facebook login</button>

        </div>
    </div>


    <div id="new" class="tabcontent">
        <div class="col-12 pb-5 admin-border">
            <div class="mt-3 mb-3 page-header">
                <h3>Opret dig som bruger og lav anmeldelser</h3>
            </div>
            <form ng-submit="create_user()">
                <div class="form-group">
                    <label for="r_name">Navn</label>
                    <input type="text" class="form-control" id="r_name" placeholder="Dit fulde navn" ng-model="name">
                </div>
                <div class="form-group">
                    <label for="r_email">Email</label>
                    <input type="email" class="form-control" id="r_email" placeholder="Din email" ng-model="email">
                </div>
                <div class="form-group">
                    <label for="r_password">Password</label>
                    <input type="password" class="form-control" id="r_password" placeholder="Password" ng-model="password">
                </div>
                <div class="form-group">
                    <label for="re_password">Gentag password</label>
                    <input type="password" class="form-control" id="re_password" placeholder="Password" ng-model="passwordrepeat">
                </div>
                <button type="submit" class="btn btn-primary">Tilmeld dig</button>
                {{server_msg}}
            </form>

        </div>
    </div>
</div><!-- container -->
<script>
    function openTabs(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>