import{r as c,Q as m,h as f,k,u as s,f as l,n as u,b as e,t as d,g as a,o as p}from"./app-BfoFl66u.js";const v={key:0,id:"feedback-messages",class:"fixed bottom-10 text-sm z-40"},g={class:"whitespace-nowrap"},b={class:"whitespace-nowrap"},x={class:"whitespace-nowrap"},C={__name:"SessionFeedback",setup(y){let n=c(""),r=c(!1);const t=m(),w=f(()=>t.props.session);k([w],()=>{r.value&&i()});const i=()=>{r.value=!r.value,r.value?n.value="transform scale-0 ":n.value=""};return(h,o)=>s(t).props.session?(p(),l("div",v,[s(t).props.session.success_?(p(),l("div",{key:0,class:u(s(n)+"transition-all duration-500 ease-in-out animate-pulse font-semibold px-3 py-2 rounded bg-emerald-200 text-emerald-600 opacity-70 w-11/12 flex justify-between items-center")},[e("div",g,d(s(t).props.session.success_),1),e("div",null,[e("button",{type:"button",onClick:i},o[0]||(o[0]=[e("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",class:"w-6 h-6"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6 18 18 6M6 6l12 12"})],-1)]))])],2)):a("",!0),s(t).props.session.warnings_?(p(),l("div",{key:1,class:u(s(n)+"transition-all duration-500 ease-in-out animate-pulse font-semibold px-3 py-2 rounded bg-yellow-200 text-yellow-600 opacity-70 w-11/12 flex justify-between items-center")},[e("div",b,d(s(t).props.session.warnings_),1),e("div",null,[e("button",{type:"button",onClick:i},o[1]||(o[1]=[e("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",class:"w-6 h-6"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6 18 18 6M6 6l12 12"})],-1)]))])],2)):a("",!0),s(t).props.session.errors_?(p(),l("div",{key:2,class:u(s(n)+"transition-all duration-500 ease-in-out animate-pulse font-semibold px-3 py-2 rounded bg-red-200 text-red-600 opacity-70 w-11/12 flex justify-between items-center")},[e("div",x,d(s(t).props.session.errors_),1),e("div",null,[e("button",{type:"button",onClick:i},o[2]||(o[2]=[e("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",class:"w-6 h-6"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6 18 18 6M6 6l12 12"})],-1)]))])],2)):a("",!0)])):a("",!0)}};export{C as default};
