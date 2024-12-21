import{A as M}from"./ApplicationLogo-CgdtnhBC.js";import{p as N,z as D,h as v,r as B,o as d,f as h,b as e,y as c,i as k,x as $,a,w as n,n as u,A as j,c as y,u as b,j as x,d as l,g as C,t as m}from"./app-BfoFl66u.js";import z from"./SessionFeedback-xsvGFZ6J.js";const E={class:"relative"},A={__name:"Dropdown",props:{align:{type:String,default:"right"},width:{type:String,default:"48"},contentClasses:{type:String,default:"py-1 bg-white"}},setup(r){const o=r,t=g=>{i.value&&g.key==="Escape"&&(i.value=!1)};N(()=>document.addEventListener("keydown",t)),D(()=>document.removeEventListener("keydown",t));const s=v(()=>({48:"w-48"})[o.width.toString()]),p=v(()=>o.align==="left"?"ltr:origin-top-left rtl:origin-top-right start-0":o.align==="right"?"ltr:origin-top-right rtl:origin-top-left end-0":"origin-top"),i=B(!1);return(g,f)=>(d(),h("div",E,[e("div",{onClick:f[0]||(f[0]=w=>i.value=!i.value)},[c(g.$slots,"trigger")]),k(e("div",{class:"fixed inset-0 z-40",onClick:f[1]||(f[1]=w=>i.value=!1)},null,512),[[$,i.value]]),a(j,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"opacity-0 scale-95","enter-to-class":"opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"opacity-100 scale-100","leave-to-class":"opacity-0 scale-95"},{default:n(()=>[k(e("div",{class:u(["absolute z-50 mt-2 rounded-md shadow-lg",[s.value,p.value]]),style:{display:"none"},onClick:f[2]||(f[2]=w=>i.value=!1)},[e("div",{class:u(["rounded-md ring-1 ring-black ring-opacity-5",r.contentClasses])},[c(g.$slots,"content")],2)],2),[[$,i.value]])]),_:3})]))}},L={__name:"DropdownLink",props:{href:{type:String,required:!0}},setup(r){return(o,t)=>(d(),y(b(x),{href:r.href,class:"block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"},{default:n(()=>[c(o.$slots,"default")]),_:3},8,["href"]))}},S={__name:"NavLink",props:{href:{type:String,required:!0},active:{type:Boolean}},setup(r){const o=r,t=v(()=>o.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out");return(s,p)=>(d(),y(b(x),{href:r.href,class:u(t.value)},{default:n(()=>[c(s.$slots,"default")]),_:3},8,["href","class"]))}},_={__name:"ResponsiveNavLink",props:{href:{type:String,required:!0},active:{type:Boolean}},setup(r){const o=r,t=v(()=>o.active?"block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out":"block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out");return(s,p)=>(d(),y(b(x),{href:r.href,class:u(t.value)},{default:n(()=>[c(s.$slots,"default")]),_:3},8,["href","class"]))}},V={class:"min-h-screen bg-gray-100"},q={class:"bg-white border-b border-gray-100"},O={class:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"},P={class:"flex justify-between h-16"},T={class:"flex"},I={class:"shrink-0 flex items-center"},R={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},U={class:"hidden sm:flex sm:items-center sm:ms-6"},W={class:"ms-3 relative"},F={class:"inline-flex rounded-md"},G={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"},H={class:"-me-2 flex items-center sm:hidden"},J={class:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},K={class:"pt-2 pb-3 space-y-1"},Q={class:"pt-4 pb-1 border-t border-gray-200"},X={class:"px-4"},Y={class:"font-medium text-base text-gray-800"},Z={class:"font-medium text-sm text-gray-500"},ee={class:"mt-3 space-y-1"},te={key:0,class:"bg-white shadow"},se={class:"max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"},oe={class:"p-2"},ne={class:"py-12"},re={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},ae={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg"},ie={class:"p-6 text-gray-900"},ce={__name:"AuthenticatedLayout",setup(r){const o=B(!1);return(t,s)=>(d(),h("div",null,[a(z),e("div",V,[e("nav",q,[e("div",O,[e("div",P,[e("div",T,[e("div",I,[a(b(x),{href:t.route("home")},{default:n(()=>[a(M,{class:"block h-9 w-auto fill-current text-gray-800"})]),_:1},8,["href"])]),e("div",R,[a(S,{href:t.route("pembelians.index"),active:t.route().current("pembelians.index")},{default:n(()=>s[1]||(s[1]=[l(" Pembelian ")])),_:1},8,["href","active"]),t.$page.props.auth.user.clearance_level>=3?(d(),y(S,{key:0,href:t.route("initial_commands.index"),active:t.route().current("initial_commands.index")},{default:n(()=>s[2]||(s[2]=[l(" Initial Commands ")])),_:1},8,["href","active"])):C("",!0)])]),e("div",U,[e("div",W,[a(A,{align:"right",width:"48"},{trigger:n(()=>[e("span",F,[e("button",G,[l(m(t.$page.props.auth.user.name)+" ",1),s[3]||(s[3]=e("svg",{class:"ms-2 -me-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"},[e("path",{"fill-rule":"evenodd",d:"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z","clip-rule":"evenodd"})],-1))])])]),content:n(()=>[a(L,{href:t.route("profile.edit")},{default:n(()=>s[4]||(s[4]=[l(" Profile ")])),_:1},8,["href"]),a(L,{href:t.route("logout"),method:"post",as:"button"},{default:n(()=>s[5]||(s[5]=[l(" Log Out ")])),_:1},8,["href"])]),_:1})])]),e("div",H,[e("button",{onClick:s[0]||(s[0]=p=>o.value=!o.value),class:"inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"},[(d(),h("svg",J,[e("path",{class:u({hidden:o.value,"inline-flex":!o.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),e("path",{class:u({hidden:!o.value,"inline-flex":o.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])]),e("div",{class:u([{block:o.value,hidden:!o.value},"sm:hidden"])},[e("div",K,[a(_,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:n(()=>s[6]||(s[6]=[l(" Dashboard ")])),_:1},8,["href","active"])]),e("div",Q,[e("div",X,[e("div",Y,m(t.$page.props.auth.user.name),1),e("div",Z,m(t.$page.props.auth.user.email),1)]),e("div",ee,[a(_,{href:t.route("profile.edit")},{default:n(()=>s[7]||(s[7]=[l(" Profile ")])),_:1},8,["href"]),a(_,{href:t.route("logout"),method:"post",as:"button"},{default:n(()=>s[8]||(s[8]=[l(" Log Out ")])),_:1},8,["href"])])])],2)]),t.$slots.header?(d(),h("header",te,[e("div",se,[c(t.$slots,"header")])])):C("",!0),e("main",oe,[c(t.$slots,"default")]),e("div",ne,[e("div",re,[e("div",ae,[e("div",ie,"Welcome, "+m(t.$page.props.auth.user.username)+"!",1)])])])])]))}};export{ce as _};