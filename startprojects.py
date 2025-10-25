import os, sys, shutil, tempfile, time
from collections import Counter


#Variáveis
arr = list()
arqConfig = "C:/xampp/apache/conf/httpd.conf"

#Início do programa
cwd = os.getcwd().replace('\\','/')
x = cwd.split("/")
print("________________________________________________")
print("Projeto WEB: ", x[len(x)-1])
print("Diretório atual:",cwd)
print("________________________________________________")
print("")


#Code
def SearchTXT(arquivo, pesquisa):        
    with open(arquivo) as f:
        ocorrencias = f.read().count(pesquisa)

    with open(arquivo) as f:
        i=0      
        for l_num, l in enumerate(f, 1): 
            if pesquisa in l: 
                #print(pesquisa,' foi encontrada na linha', l_num)            
                arr.append(l_num)            
                if i==ocorrencias:
                    break
                else:
                    i+=1                    
        ReWrite(arquivo, pesquisa, arr[0], 0)
        
def ReWrite(arquivo, pesquisa, line, fase):
    dirSet = pesquisa + '"'+ cwd +'"'
    if fase == 1:
        dirSet = pesquisa + ' "'+ cwd +'">'
    with open(arquivo, 'r') as arquivoRep, \
         tempfile.NamedTemporaryFile('w', delete=False) as out:
        for index, linha in enumerate(arquivoRep, start=1):
            if index == line: 
                out.write(dirSet + "\n")
                print("Diretório PHP alterado para: ")
                print("[",dirSet,"] \n")
            else:
                out.write(linha)

    # move o arquivo temporário para o original
    shutil.move(out.name, arquivo)
print("--> Corrigindo Diretórios <-- \n")

print('Step 1...')
SearchTXT(arqConfig,"DocumentRoot ")

print("")
lineChange = arr[0] + 1 

print('Step 2...')
ReWrite(arqConfig,"<Directory", lineChange, 1)
print("________________________________________________")
print("")

#Inicando Programas
print("--> Iniciando Serviços <-- \n")
os.startfile(os.getcwd()+"/startprojects/apache_start.bat")
print("--> Serviço Apache Iniciado:    ", time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()))

os.startfile(os.getcwd()+"/startprojects/mysql_start.bat")
print("--> Serviço MYSQL Iniciado:     ", time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()))

os.startfile(os.getcwd()+"/startprojects/php_artisan_serve.bat")
print("--> Servidor Laravel Iniciado:  ", time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()))
print("________________________________________________")
print("")
input('--> Press to Stop Apache & MYSQL...')
print("________________________________________________")
print("")

print("--> Finalizando Serviços <-- \n")

os.startfile(os.getcwd()+"/startprojects/mysql_stop.bat")
print("--> Serviço MYSQL Parado: ", time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()))

os.startfile(os.getcwd()+"/startprojects/apache_stop.bat")
print("--> Serviço Apache Parado: ", time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()))

input('--> Press to Exit...')



    







