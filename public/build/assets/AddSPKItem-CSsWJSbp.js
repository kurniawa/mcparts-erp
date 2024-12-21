import{r as n,f as g,b as e,n as j,u,a as C,i as k,l as w,g as B,o as b}from"./app-BfoFl66u.js";import{l as p,_ as T}from"./AutoCompleteAPI-DqwSXif2.js";const _={class:"flex items-center mt-1"},z={class:"ml-2 w-full"},D={key:0,class:"mt-1"},V={class:"flex gap-1 justify-center items-center"},M={__name:"AddSPKItem",props:{keySPKItem:Number},emits:["chosenSPKItem","removeSPKItem"],setup(x,{emit:K}){const s=x,S=["id","name"],i=K,a=n(0),o=n({});function y(c){o.value={itemID:c.id,itemName:c.name,jumlahItem:a.value,keterangan:l.value,iSPKItem:s.keySPKItem},i("chosenSPKItem",o.value)}function I(){p.isEmpty(o.value)?o.value={itemID:null,itemName:null,jumlahItem:a.value,keterangan:l.value,iSPKItem:s.keySPKItem}:o.value={itemID:o.value.itemID,itemName:o.value.itemName,jumlahItem:a.value,keterangan:l.value,iSPKItem:s.keySPKItem},i("chosenSPKItem",o.value)}const h=p.debounce(I,500),f=p.debounce(I,1e3);let r=n(!1);const l=n(null),d=n(null);let v=n("border rounded border-yellow-300 text-yellow-500 font-semibold");function P(){r.value=!r.value,r.value?(d.value&&(l.value=d.value),v.value="border rounded border-yellow-300 text-yellow-500 bg-yellow-200 font-semibold"):(l.value&&(d.value=l.value,l.value=null),v.value="border rounded border-yellow-300 text-yellow-500 font-semibold"),f()}function N(){i("removeSPKItem",s.keySPKItem)}return(c,t)=>(b(),g("tr",null,[e("td",null,[e("div",_,[e("button",{type:"button",class:j(u(v)),onClick:P},t[4]||(t[4]=[e("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"3",stroke:"currentColor",class:"w-3 h-3"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M12 4.5v15m7.5-7.5h-15"})],-1)]),2),e("div",z,[C(T,{apiName:"search_products",placeholder:"nama produk",onParamsToEmit:y,parametersToAssign:S}),u(r)?(b(),g("div",D,[k(e("textarea",{"onUpdate:modelValue":t[0]||(t[0]=m=>l.value=m),onInput:t[1]||(t[1]=()=>u(f)()),cols:"30",rows:"3",class:"border-slate-300 rounded-lg text-xs p-1 placeholder:text-slate-400",placeholder:"keterangan item..."},null,544),[[w,l.value]])])):B("",!0)])])]),e("td",null,[e("div",V,[k(e("input",{type:"number","onUpdate:modelValue":t[2]||(t[2]=m=>a.value=m),onInput:t[3]||(t[3]=m=>u(h)()),min:"1",step:"1",class:"border-slate-300 rounded-lg text-xs p-1 w-1/2"},null,544),[[w,a.value]]),e("button",{type:"button",class:"text-red-300",onClick:N},t[5]||(t[5]=[e("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",class:"size-6"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"})],-1)]))])])]))}};export{M as default};
