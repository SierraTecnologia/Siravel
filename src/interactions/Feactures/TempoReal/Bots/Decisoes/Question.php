<?php

namespace App\Http\Bots\Decisoes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Question extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Tratar Mensagem Recebida
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create($assunto)
    {

    }

    /**
     * 
     */
    public function verify()
    {
        // Exibe
        return view('home');
    }

    /**
     * Exibir dashboards e relatórios
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sentimento()
    {
        // Exibe o Progresso por Hora


        // Exibe o Progresso do Dia!


        // Exibe o Progresso do Mes! (Caso Mais de Um Mes)

        // Exibe o Progresso 
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reply()
    {
        // Verifica se tem algum processo em aberto se tiver Inicia Ele
        // @todo 
        
        // Nunca respondeu uma pergunta ?
        // Iniciar Perguntas do Inicio

        // Esta busca de coleira/encoleirado ?
        // Se sim


        return view('home');
    }

    /**
     * Endereço para Fazer Algo
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function make()
    {
        return view('home');
    }
}
