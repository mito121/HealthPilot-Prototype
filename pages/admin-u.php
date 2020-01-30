<div class="container my-5" ng-controller="usersCtrl">
    <div class="page-header">
        <h2>Brugere</h2>      
    </div>
    <div class="row py-3">
        <div class="col col-lg col-12 bg-white p-3 m-3">
            <h5><strong>Tilføj bruger</strong></h5>
            <div style="height:98px"></div>
            <form ng-submit="create_user()">

                <label for="r_name">Navn</label>
                <input type="text" class="form-control" ng-model="name" required>

                <label for="r_email">Email</label>
                <input type="email" class="form-control" ng-model="email" required>

                <label for="r_password">Adgangskode</label>
                <input type="password" class="form-control" placeholder="********" ng-model="password" required>

                <label for="r_password">Gentag adgangskode</label>
                <input type="password" class="form-control" placeholder="********" ng-model="passwordrepeat" required>

                <br>
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="img">Vælg foto ** IKKE AKTIV ***</label><br>
                            <input type="file" file-input="files" id="imageUpload" onchange="angular.element(this).scope().setFile(this)">
                        </div>
                    </div>
                    <div class="col-4 my-3 right">
                        <img class="img-thumbnail img-hp" ng-src='images/user.jpg'>			
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tilføj bruger</button>
                {{insert_response}}
            </form>
        </div>

        <div class="col col-lg col-12 bg-white p-3 m-3">
            <h5><strong>Tilret bruger</strong></h5>

            <form ng-init="userOptions()">
                <label for="user">Vælg</label><br>
                <select class="form-control selectpicker" id="user" ng-model="searchUsers" ng-change="select_user()"
                        ng-options="userOption as userOption.name for userOption in optionUsers track by userOption.id">
                </select>
            </form>
            <br>

            <form class="pb-3" ng-submit="updateUser(userId, newName, newPassword, newEmail, newRole.role_id)">

                <input type="hidden" ng-model="userId">

                <label for="newName">Navn</label>
                <input type="text" ng-model="newName" id="newName" class="form-control" placeholder="">

                <label for="newEmail">Mail</label>
                <input type="text" ng-model="newEmail" class="form-control" id="newEmail" placeholder="">

                <label for="newPassword">Adgangskode</label>
                <input type="text" ng-model="newPassword" class="form-control" id="newPassword" placeholder="********">

                <label for="newRole">Rolle</label>
                <div ng-init="roleOptions()">
                    <select class="form-control selectpicker" id="newRole" ng-model="newRole"
                            ng-options="roleOption as roleOption.role for roleOption in optionRoles track by roleOption.role_id">
                    </select>
                </div>
                <br>
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="img">Vælg foto</label>
                            <input type="file" file-input="files" id="newImage" onchange="angular.element(this).scope().setFile(this)">
                        </div>
                    </div>
                    <div class="col-4 my-3 right">
                        <img ng-if="selected_img" src="uploads/{{selected_img}}" class="img-thumbnail">			
                        <img ng-if="!selected_img" src="https://avatars.io/facebook/{{selected_fbId}}/medium" class="img-thumbnail">			
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" style="width:100%" value="Ret bruger">
            </form>
            {{update_response}}

            <form class="pb-3" ng-submit="delete_user(userId)">
                <input type="submit" class="btn btn-warning" style="width:100%" value="Slet bruger">
                {{delete_response}}
            </form>		

        </div>
    </div>
</div><!-- container -->