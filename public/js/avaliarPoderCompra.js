function calcular(taxa, salario, entrada, anos, valor){
    const valorFinanciado = valor - entrada;
    const taxaJurosMensal = taxa / 12;
    const numPagamentos = anos * 12;
    const parcela = (valorFinanciado * taxaJurosMensal) / (1 - Math.pow(1 + taxaJurosMensal, - numPagamentos));

    const limiteParcela = salario * 0.3;
    if (parcela > limiteParcela) {
        return "Parcela incompatível com a renda";
    }

    const resultado = Math.round(parcela, 2).toLocaleString('pt-BR')
    return `R$ ${resultado}`;
}


function simular(){
    const renda = document.querySelector("#renda")
    const entrada = document.querySelector("#entrada")
    const anos = document.querySelector("#anos")
    const valor = document.querySelector("#valor")
    const resultado = document.querySelector("#resultado");
    resultado.innerHTML = ""
    const erros = []

    if(!renda.value){
        erros.push("O campo renda é obrigatorio")
    }

    if(!entrada.value){
        erros.push("O campo entrada é obrigatorio")
    }

    if(!anos.value){
        erros.push("O campo anos é obrigatorio")
    }

    if(!valor.value){
        erros.push("O campo valor do imóvel é obrigatorio")
    }
    
    if(entrada.value < valor.value * 0.2){
        erros.push("Valor de entrada deve ser maior que 20% do valor do imóvel")
    }

    if(anos.value > 35){
        erros.push("O prazo máximo de financiamento é de 35 anos")
    }

    if(erros.length > 0){
        let text = ''

        for(let i = 0; i < erros.length;i++){
            text += erros[i]
            text += "\n"
        }

        alert(text)

        return
    }

    const bancos = [
        {banco: "itau", taxa: 0.1049, imagem: "https://upload.wikimedia.org/wikipedia/commons/2/2d/2023_Ita%C3%BA_Unibanco_Logo.png"},
        {banco:"caixa", taxa: 0.0999, imagem: "https://logodownload.org/wp-content/uploads/2014/02/caixa-logo-6.png"},
        {banco:"santander", taxa: 0.1099, imagem: "https://logodownload.org/wp-content/uploads/2017/05/santander-logo-1.png"},
        {banco:"bradesco", taxa: 0.1149, imagem: "https://upload.wikimedia.org/wikipedia/commons/a/a6/Banco_Bradesco_logo_%28horizontal%29.png"}
    ]

    const table = document.createElement('table')
    const tableHeader = "<tr><th class='rounded-tl-lg text-center py-2 bg-gray-700'>Banco</th><th class='text-center py-[2px]px-4 w-6/12 bg-gray-700 rounded-tr-lg'>Parcelas</th></tr>"
    table.innerHTML = tableHeader
    table.classList.add("w-6/12", "bg-gray-900", "shadow-md", "rounded-lg", "my-4", "max-[500px]:w-[90%]")

    for(let i = 0; i < bancos.length; i++){
        const row = document.createElement('tr')
        const content = `<td class="text-center py-2 px-4 text-white"><img src="${bancos[i].imagem}" class="block mx-auto h-[30px]"/></td><td class="text-center py-[2px] text-white font-bold">${calcular(bancos[i].taxa,renda.value,entrada.value,anos.value, valor.value)}</td>`
        row.innerHTML = content
        table.appendChild(row)    
    }

    resultado.append(table)
}