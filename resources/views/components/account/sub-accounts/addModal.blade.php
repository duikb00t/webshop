<div class="modal fade" id="addAccountDialog" tabindex="-1" role="dialog" aria-labelledby="addAccount">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" method="POST">

                {{ csrf_field() }}
                {{ method_field('put') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sub account toevoegen</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 hidden-xs control-label">Gebruikersnaam*</label>
                        <div class="col-xs-12 col-sm-9">
                            <input name="username" class="form-control" placeholder="Gebruikersnaam" maxlength="100" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-3 hidden-xs control-label">Email*</label>
                        <div class="col-xs-12 col-sm-9">
                            <input type="email" name="email" class="form-control" placeholder="Email" maxlength="150" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-3 hidden-xs control-label">Wachtwoord*</label>
                        <div class="col-xs-12 col-sm-9">
                            <input type="password" name="password" class="form-control" placeholder="Wachtwoord" maxlength="100" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="col-sm-3 hidden-xs control-label">Wachtwoord (verificatie)*</label>
                        <div class="col-xs-12 col-sm-9">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Wachtwoord (verificatie)" maxlength="100" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="selectRole" class="col-sm-3 control-label">Rol</label>
                        <div class="col-xs-12 col-sm-4">
                            <select name="role" class="form-control" autocomplete="off">
                                <option value="">--- Selecteer een rol ---</option>

                                @if (auth()->isAdmin())
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                @endif

                                @if (auth()->isManager())
                                    <option value="manager" {{  old('role') === 'manager' ? 'selected' : '' }}>Manager</option>
                                @endif

                                <option value="user" {{  old('role') === 'user' ? 'selected' : '' }}>Gebruiker</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Annuleren</button>

                    <br class="visible-xs" />

                    <button class="btn btn-primary">Account aanmaken</button>
                </div>
            </form>
        </div>
    </div>
</div>