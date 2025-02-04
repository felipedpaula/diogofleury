<?php

namespace App\Http\Controllers\SiteControllers;
use App\Rules\ReCaptcha;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\Contato;
use App\Mail\ContatoRecebido;
use Illuminate\Http\Request;
use Exception;

class ContatoController extends Controller
{
    private $dadosPagina;

    public function index()
    {
        return view('site.paginas.contato.index');
    }

    public function sendMessage(Request $request) {
        // Validação dos dados do formulário
        $dados = $request->validate([
            'nome' => 'required|max:255',
            'email' => 'nullable|email',
            'tel' => 'nullable',
            'mensagem' => 'required',
            'g-recaptcha-response' => [new ReCaptcha()]
        ]);

        try {
            Contato::create($dados);
        } catch (Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao enviar a mensagem. Por favor, tente novamente.');
        }

        // Mail::to('felipeppdev@gmail.com')->send(new ContatoRecebido($dados));
        return back()->with('success', 'Sua mensagem foi enviada com sucesso!');
    }
}
