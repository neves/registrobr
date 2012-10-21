<?php

namespace Qi\Tests\RegistroBr;
use Qi\RegistroBr\Types;

class TypesTest extends \PHPUnit_Framework_TestCase
{
    public function testDisponivel()
    {
        $tests = array(
            Types::LIMIT => 'taxa_maxima',

            Types::DISPONIVEL => 'busca_disponivel',

            Types::INVALIDO_CONSULTA => 'busca_consulta_invalida',
            Types::INVALIDO_TAMANHO => 'busca_tamanho_maximo',
            Types::INVALIDO_DOMINIO => 'busca_dominio_invalido',
            Types::INVALIDO_DPN => 'busca_dpn_invalido',

            Types::INDISPONIVEL_TICKET => 'busca_disponivel_ticket',
            Types::INDISPONIVEL_6_PROCESSOS => 'busca_nao_disponivel_6_processos',
            Types::INDISPONIVEL_DOCUMENTACAO => 'busca_nao_disponivel_documentacao',
            Types::INDISPONIVEL_PALAVRA_RESERVADA => 'busca_palavra_reservada',
            Types::INDISPONIVEL_REGISTRADO => 'busca',
        );

        foreach($tests as $type => $fixture) {
            $this->typeTest($fixture, $type);
        }
    }

    /**
     * @expectedException \DomainException
     */
    public function testException()
    {
        $html = $this->load('busca_dominio_invalido');
        $html = str_replace('Motivo:', 'foobar:', $html);
        Types::recognize($html);
    }

    protected function typeTest($fixture, $expectedType)
    {
        $html = $this->load($fixture);
        $type = Types::recognize($html);
        $this->assertEquals($expectedType, $type);
    }

    protected function load($name)
    {
        return file_get_contents(FIXTURES_DIR."/$name.htm");
    }
}
