@echo off
wget http://registro.br/info/dpn.html -O dpn.htm
wget http://registro.br/cgi-bin/whois/?qr=locaweb.com.br -O whois_domain.htm
wget http://registro.br/cgi-bin/whois/?qr=GIM6 -O whois_id.htm
wget http://registro.br/cgi-bin/whois/?qr=002.351.877/0001-52 -O whois_entidade.htm
wget http://registro.br/cgi-bin/whois/?qr=p2 -O whois_provedor.htm
wget https://registro.br/cgi-bin/avail/?qr=locaweb.com.br -O busca_publicado.htm --no-check-certificate
wget https://registro.br/cgi-bin/avail/?qr=dominio-inexistente.com.br -O busca_disponivel.htm --no-check-certificate
wget https://registro.br/cgi-bin/avail/?qr=0x.com.br -O busca_nao_disponivel_6_processos.htm --no-check-certificate
wget https://registro.br/cgi-bin/avail/?qr=rds.tv.br -O busca_congelado.htm --no-check-certificate
wget https://registro.br/cgi-bin/avail/?qr=1000x.com.br -O busca_disponivel_ticket.htm --no-check-certificate
wget https://registro.br/cgi-bin/avail/?qr=reciclado.com.br -O busca_nao_disponivel_documentacao.htm --no-check-certificate
wget https://registro.br/cgi-bin/avail/?qr=a.com.br -O busca_dominio_invalido.htm --no-check-certificate
wget https://registro.br/cgi-bin/avail/?qr=www.com.br -O busca_palavra_reservada.htm --no-check-certificate
wget https://registro.br/cgi-bin/avail/?qr=@.com.br -O busca_consulta_invalida.htm --no-check-certificate
wget https://registro.br/cgi-bin/avail/?qr=abcdefghijklmnopqrstuvwxyz0.com.br -O busca_tamanho_maximo.htm --no-check-certificate
wget https://registro.br/cgi-bin/avail/?qr=abc.co.br -O busca_dpn_invalido.htm --no-check-certificate
wget https://registro.br/cgi-bin/avail/?qr=1c.com.br -O busca_aguardando.htm --no-check-certificate
pause