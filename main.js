var nav=document.querySelector('nav ul');
const handleClick = (e) => {
    const active = nav.querySelector('.active');
    if(active && e.target.nodeName=="A"){
      active.classList.remove('active');
    }
    if(e.target.nodeName=="A")
    e.target.classList.add('active');
}
nav.addEventListener('click',handleClick)


var walletCurrency=document.querySelector("#walletCurrency")
	const currencyList=fetch('https://openexchangerates.org/api/currencies.json').then(response=>response.json()).then(data=>{
		Object.keys(data).forEach(values=>{
			var myNewOption = new Option(values,values)
			walletCurrency.add(myNewOption)
		})
})

