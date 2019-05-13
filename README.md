# Easymplex

Aplicação: https://easymplex.herokuapp.com/   
Versionamento: https://github.com/JessicaVicentini99/Simplex

Projeto de Pesquisa Operacional
5º Semestre BCC UNIVEM

Jéssica Vicentini RA: 57036-2
Matheus Santi RA: 57369-8
Melissa Seren RA: 569518


O Simplex permite que se encontre valores ideais em situações em que diversos aspectos precisam ser respeitados. Diante de um problema, são estabelecidas inequações que representam restrições para as variáveis. A partir daí, testa-se possibilidades de maneira a otimizar, isto é, maximizar ou minimizar o resultado da forma mais rápida possível.

O algoritmo da mochila consiste em preencher a mochila com objetos diferentes de pesos e valores. O objetivo é que preencha a mochila com o maior valor possível, não ultrapassando o peso máximo.


## Ferramentas

- Javascript
- JQuery
- Bootstrap
- PHP
- Template Creative Tim https://www.creative-tim.com/ 	
- GitHub para versionamento
- Heroku para hospedagem

## Nota de realease a ser publicado
1.0.0

###Simplex

- Algoritmo Simplex para problemas de maximização.
- Algoritmo Simplex para problemas de minimização.
- É exibido o passo a passo das tabelas geradas pelo método Simplex
- Tabela de Sensibilidade.

##Entradas personalizadas para:

###Simplex

- Limite máximo de iterações
- Tipo de Simplex (MAX ou MIN)
- Quantidade de variáveis e restrições

##Limitações

###Simplex

- Em cada variável da função objetivo e das restrições deve conter apenas o número, sem a adição do 'x', separando os números por ';' e caso tenha alguma variável nula, é necessário inserir o 0.

##Datas Importantes

###Simplex

Datas | Eventos
--------- | ------
22/04/19     | Resolver Problemas de Maximização
22/04/19     | Número dinâmico de variáveis e restrições
22/04/19     | Resultado simplificado
29/04/19     | Resolver Problemas de Minimização
29/04/19     | Relatório de análise de sensibilidade
06/05/19     | Solução Passo-a-Passo
06/05/19     | Explicação das ações no passo-a-passo
13/05/19     | Tratar soluções infinitas ou sem solução
13/05/19     | Informações sobre o funcionamento do algoritmo
13/05/19     | Quantidade máxima de iterações
13/05/19    | Atualizando README

##Compatibilidade

Requisitos | Ferramentas
--------- | ------
Navegadores     | Mozila Firefox, Chrome
Sistema Operacional    | Windows, Mac

##Tecnologias

Tecnologias | Ferramentas
--------- | ------
Front-End     | HTML, Javascript, JQuery, Bootstrap
Back-End    | Javascript, PHP
Editor de Texto  | Sublime e PHP Storm
Servidor Web    | https://www.heroku.com/platform

##Atividades Realizadas no Período

###Simplex

Código | Título | Tarefa | Situação | Observação
--------- | ------ | -------| -------| -------
1 | Resolver Problemas de Maximização| Montar a Tabela Simplex, e possibilitar o usuário a maximizar modelos de simplex com sistemas lineares. | Concluído | Apenas restrições de “<=”
2 | Resolver Problemas de Minimização | Montar a Tabela Simplex, e possibilitar o usuário a minimizar modelos de simplex com sistemas lineares. | Concluído | Apenas restrições de “<=”
3 | Solução passo-a-passo | Possibilitar o usuário navegar entre as iterações. | Concluído |
4 | Número dinâmico de variáveis e restrições | Possibilitar o usuário a inserir o número de variáveis e restrições. | Concluído |
5 | Tratar soluções infinitas ou sem solução | Tratar problemas sem solução ou com solução infinita. | Concluído |
6 | Resultado simplificado | Demonstrar ao usuário a tabela com a solução final. | Concluído|
7  | Relatório de análise de sensibilidade | Demonstrar ao usuário a tabela de sensibilidade. |Concluído|
8  | Quantidade máxima de iterações | Permitir ao usuário definir a quantidade maxima de iterações. |Concluído|
9  | Informações sobre o funcionamento do algoritmo | Informações completas sobre Programação Linear e o método de resolução SIMPLEX!. |Concluído|
10  | Explicação das ações no passo-a-passo | Explicação basica do funcionamento. |Concluído|

