require 'rubygems'
require 'nanotest'
include  Nanotest

html = IO.read("mocks/whois_domain.htm")
html.scan /<pre>(.*)<\/pre>/im
pre = $1

info = {
  :entidade => pre.match(/^entidade:\s+(.*)/)[1],
  :documento => pre.match(/^documento:.+>(.+?)</)[1],
  :responsavel => pre.match(/^responsável:\s+(.*)/)[1],
  :pais => pre.match(/^país:\s+(.*)/)[1],
  :id_entidade => pre.match(/^id entidade:\s+(.*)/i)[1],
  :criado => pre.match(/^criado:\s+(.+?)</i)[1],
  :alterado => pre.match(/^alterado:\s+(.*)/i)[1],
  :id => pre.match(/^ID:\s+(.*)/i)[1],
  :nome => pre.match(/^nome:\s+(.*)/i)[1],
  :email => pre.match(/^e-mail:\s+(.*)/i)[1],
  :id_criado => pre.scan(/^criado:\s+(.*)/i).last.first,
  :id_alterado => pre.scan(/^alterado:\s+(.*)/i).last.first,
  :dominios => pre.scan(/^domínio:\s+.*>(.*)\</i).collect(&:first)
}

target = {
	:criado=>"12/01/1998",
	:dominios=>[],
	:entidade=>"LocaWeb Ltda",
	:alterado=>"11/01/2010",
	:documento=>"002.351.877/0001-52",
	:nome=>"LocaWeb Ltda.",
	:responsavel=>"Gilberto Mautner",
	:email=>"regcom@locaweb.com.br",
	:pais=>"BR",
	:id_criado=>"16/03/2000",
	:id=>"GIM6",
	:id_entidade=>"GIM6",
	:id_alterado=>"15/06/2005"
}

assert { info == target }

html = IO.read("mocks/busca.htm")
assert { html.match(/\d{4}-\d{2}-\d{2}/)[0] == "2011-01-12" }
assert { html.match(/Status<\/B>: (.*?)</)[1] == "Publicado" }
assert { html.scan(/Servidor DNS:<\/B> (.*?)</).collect(&:first) == ["ns1.locaweb.com.br", "ns2.locaweb.com.br", "ns3.locaweb.com.br"] }

assert { IO.read("mocks/taxa_maxima.htm").include? "Taxa máxima de consultas excedida" }
