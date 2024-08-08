@extends(layout())
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form id="form-login" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('auth.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('auth.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required  autocomplete="on">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                   <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('auth.rememberme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button id="button-submit" type="submit" class="btn btn-primary">
                                    {{ __('auth.login') }}
                                </button>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('auth.forgotyoupassword') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const btn_submit = document.querySelector('#button-submit')
    btn_submit.addEventListener("click", (event) => {
        alert(event)
    });
    console.log(btn_submit)
  
    function postform(){
    let href = window.location.href
    let form = document.querySelector('#form-login')
        
        let config =  {
            headers: {
                'Content-Type': 'application/json'
            }
        }

        let form_object =  Object.fromEntries(new FormData(form));
        axios.post(url,form_object,config)
            .then(response=>{
                console.log('deu certo')
                console.log(response)
            })
            .catch(error => {
                    console.error(error);
                }
            )

    }
    // postform();
</script>
@endsection