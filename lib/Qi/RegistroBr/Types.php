<?php

namespace Qi\RegistroBr;

class Types
{
    const LIMIT = 'taxa_maxima_consulta_excedida';

    const INVALIDO_CONSULTA = 'consulta_invalida';
    const INVALIDO_TAMANHO = 'invalido_tamanho';
    const INVALIDO_DOMINIO = 'dominio_invalido';
    const INVALIDO_DPN = 'dpn_invalido';

    const INDISPONIVEL_TICKET = 'indisponivel_ticket';
    const INDISPONIVEL_6_PROCESSOS  = 'indisponivel_6_processos';
    const INDISPONIVEL_DOCUMENTACAO = 'indisponivel_documentacao';
    const INDISPONIVEL_PALAVRA_RESERVADA = 'indisponivel_palavra_reservada';
    const INDISPONIVEL_REGISTRADO = 'indisponivel_registrado';

    const DISPONIVEL = 'disponivel';

    protected static $PATTERNS = array(
        self::LIMIT => 'Taxa máxima de consultas excedida',

        self::INVALIDO_CONSULTA => 'Dom&iacute;nio consultado inv&aacute;lido',
        self::INVALIDO_TAMANHO => 'Motivo: Domínio inválido, Tamanho máximo de 26 caracteres',
        self::INVALIDO_DOMINIO => 'Motivo: Domínio inválido',
        self::INVALIDO_DPN => 'Motivo: DPN inválido',

        self::INDISPONIVEL_TICKET => 'existe(m) ticket(s) emitidos para este dom&iacute;nio',
        self::INDISPONIVEL_6_PROCESSOS => 'Motivo: Domínio não disponível para registro por ter participado de mais de 6 (seis) processos de liberação consecutivos',
        self::INDISPONIVEL_DOCUMENTACAO => 'Motivo: Domínio encontra-se em fase de averiguação de documentação dentro do processo de liberação',
        self::INDISPONIVEL_PALAVRA_RESERVADA => 'Motivo: Palavra reservada pelo CG',
        self::INDISPONIVEL_REGISTRADO => 'Dom&iacute;nio j&aacute; registrado',

        self::DISPONIVEL => 'Dom&iacute;nio dispon&iacute;vel para registro',
    );

    public static function recognize($html)
    {
        $html = utf8_encode($html);
        foreach(self::$PATTERNS as $k => $v) {
            if ( self::match($v, $html) ) return $k;
        }
        $msg = self::between($html, '<body>', '</body>');
        throw new \DomainException($msg);
    }

    protected static function match($s, $html)
    {
        $s = preg_quote($s);
        return (bool)preg_match("!$s!iums", $html);
    }

    protected static function between($context, $start, $end)
    {
        $start = preg_quote($start);
        $end   = preg_quote($end);
        $match = array();
        $pattern = "!$start(.*)$end!iums";
        if ( preg_match($pattern, $context, $match) ) {
            return $match[1];
        }
        return '';
    }
}
