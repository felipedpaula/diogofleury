@extends('site.layouts.index')

@section('content')
    
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>

    <div class="fs vcenter">
        <div style="background-image: url({{asset('template/images/contact/01.webp')}});" class="bg faded-more"></div>
        <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1>Contato</h1>
                <p>Bem-vindo à página de contato! Estou ansioso para saber mais sobre você e como posso ajudar a capturar momentos especiais. Por favor, preencha o formulário para entrar em contato comigo.</p>
                <div class="social-links">
                    <div class="social-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!-- Font Awesome Free 5.15.3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) --><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                        <a href="https://www.instagram.com/diogofleury/" target="_blank" rel="noopener noreferrer">@diogofleury</a>
                    </div>
                    <div class="social-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!-- Font Awesome Free 5.15.3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                        <a href="https://wa.me/5562999454585" target="_blank" rel="noopener noreferrer">(62) 9 99454585</a>
                    </div>
                    <div class="social-item">
                        <svg viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M288 370C242.4 370 196.8 330.1 174 313C60 233.2 25.8 204.7 3 187.6V427C3 458.475 28.5253 484 60 484H516C547.475 484 573 458.475 573 427V187.6C550.2 204.7 516 233.2 402 313C379.2 330.1 333.6 370 288 370ZM516 28H288H60C28.5253 28 3 53.5253 3 85V113.5C48.6 147.7 42.9 147.7 208.2 267.4C225.3 278.8 259.5 313 288 313C316.5 313 350.7 278.8 367.8 273.1C533.1 153.4 527.4 153.4 573 119.2V85C573 53.5253 547.475 28 516 28Z"/></svg>
                        diogopfa@gmail.com
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-2">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span style="color:#000" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h4>Ocoreu um erro!</h4>
                        <div class="d-flex justify-content-between align-items-center">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif

                <form action="{{route('sendmsg')}}" method="post" class="form mt-md" id="contact-form">
                    @csrf
                    <label>Qual o seu nome? *</label>
                    <input required type="text" name="nome" class="form-control" value="{{old("nome")}}">
                    <label>E-mail *</label>
                    <input required type="email" name="email" class="form-control" value="{{old("email")}}">
                    <label>Telefone</label>
                    <input type="number" name="tel" class="form-control" value="{{old("tel")}}">
                    <label>Como posso ajudar? *</label>
                    <textarea required name="mensagem" class="form-control"></textarea>
                    <button data-sitekey="{{env("GOOGLE_RECAPTCHA_KEY")}}" data-callback='onSubmit' data-action='submit' type="submit" class="g-recaptcha btn btn-default">Enviar</button>
                    <span class="p-md">* Esses campos são obrigatórios</span>
                </form>
            </div>
        </div>
        </div>
    </div>

    <script>
        function onSubmit(token) {
          document.getElementById("contact-form").submit();
        }
    </script>

@endsection
