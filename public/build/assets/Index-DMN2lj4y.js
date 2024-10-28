import{T as y,l as v,m as j,p as k,o as r,c as S,w as g,b as t,a as b,u as N,Z as O,e as P,d as p,t as n,f as s,r as c,F as m}from"./app-wFsgwbct.js";import{_ as T}from"./AuthenticatedLayout-DvukFGnF.js";import B from"./Pembelians-BD2jc6w-.js";import H from"./AddPembelian-DAdAheBr.js";import"./ApplicationLogo-CAAXn5rS.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./SessionFeedback-DpkBpUOj.js";import"./functions-DkIusH1I.js";import"./AutoComplete-K2-GBlwB.js";const D={class:"relative rounded mt-9"},I={class:"relative bg-white border-t z-10"},J={id:"form_new_barang",class:"hidden"},M={class:"flex justify-center"},z={class:"hidden"},C={class:"flex justify-center"},E={class:"border rounded p-2"},F={id:"pembelian-to-excel"},V={class:"border-b"},$={key:0},L={key:1},W={__name:"Index",props:{session:Object,pembelians:Object,pembelian_barangs_all:Object,alamats:Object,grand_total:Number,lunas_total:Number,from:String,until:String,pembelian_total_suppliers:Object,label_suppliers:Object,label_barang:Object},setup(l){const i=new Date;i.getDay(),i.getMonth(),i.getFullYear();const _=l;y({});const x=v([]);j(()=>{_.pembelians.forEach((w,a)=>{x[a]="opacity-0 "})});const h=()=>{};let u=k(!1);const f=()=>{u.value?u.value=!1:u.value=!0};return(w,a)=>(r(),S(T,null,{header:g(()=>a[0]||(a[0]=[t("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"},"Pembelian",-1)])),default:g(()=>[b(N(O),{title:"Pembelian"}),t("div",D,[a[16]||(a[16]=t("div",{class:"flex absolute -top-6 left-1/2 -translate-x-1/2 z-20"},null,-1)),t("div",I,[t("div",{class:"mx-1 py-1 sm:px-6 lg:px-8 text-xs"},[t("div",{class:"flex mt-2"},[t("button",{type:"button",class:"border rounded border-emerald-300 text-emerald-500 font-semibold px-3 py-1 ml-1",id:"btn_new_pembelian",onClick:f},"+ Pembelian"),a[1]||(a[1]=t("button",{type:"button",class:"border rounded border-indigo-300 text-indigo-500 font-semibold px-3 py-1 ml-1",id:"btn_new_barang",onclick:"toggle_light(this.id, 'form_new_barang', [], ['bg-indigo-200'], 'block')"},"+ Barang",-1))])]),b(H,{label_suppliers:l.label_suppliers,label_barang:l.label_barang},null,8,["label_suppliers","label_barang"]),t("div",J,[t("div",M,[t("form",{onSubmit:P(h,["prevent"]),class:"border rounded border-indigo-300 p-1 mt-1 lg:w-3/5 md:w-3/4"},a[2]||(a[2]=[t("table",{class:"text-xs w-full"},[t("tbody",null,[t("tr",null,[t("td",null,"Supplier"),t("td",null,[t("div",{class:"mx-2"},":")]),t("td",{class:"py-1"},[t("input",{type:"text",name:"supplier_nama",id:"barang_new-supplier_nama",placeholder:"nama supplier...",class:"text-xs rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600"}),t("input",{type:"hidden",name:"supplier_id",id:"barang_new-supplier_id"})])]),t("tr",null,[t("td",null,"Nama"),t("td",null,[t("div",{class:"mx-2"},":")]),t("td",null,[t("input",{type:"text",name:"barang_nama",id:"barang_new-barang_nama",placeholder:"nama barang ...",class:"w-full text-xs rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600"}),t("input",{type:"hidden",name:"barang_id",id:"barang_new-barang_id"})])]),t("tr",null,[t("td",{colspan:"3"},[t("div",{class:"my-5 border rounded p-1 border-sky-500"},[t("div",{class:"my-2 font-semibold text-center"},"Satuan - Jumlah - Harga per Satuan - Harga Total:"),t("table",{class:"w-full"},[t("tbody",null,[t("tr",null,[t("td",null,"Satuan Utama"),t("td",null,[t("div",{class:"mx-1"},":")]),t("td",null,[t("input",{type:"text",name:"satuan_main",class:"text-xs rounded p-1 w-3/4"})]),t("td",null,"Jumlah"),t("td",null,[t("div",{class:"mx-1"},":")]),t("td",null,[t("input",{type:"text",name:"jumlah_main",id:"barang_new-jumlah_main",class:"text-xs rounded p-1 w-3/4",oninput:"count_harga_total_main()"})]),t("td",null,"Harga"),t("td",null,[t("div",{class:"mx-1"},":")]),t("td",null,[t("input",{type:"text",id:"barang_new-harga_main",class:"text-xs rounded p-1",onchange:"formatNumber(this, 'barang_new-harga_main-real')"}),t("input",{type:"hidden",name:"harga_main",id:"barang_new-harga_main-real"})]),t("td",null,"Harga Total"),t("td",null,[t("div",{class:"mx-1"},":")]),t("td",null,[t("input",{type:"text",name:"harga_total_main",id:"barang_new-harga_total_main",class:"text-xs rounded p-1",onchange:"formatNumber(this, 'barang_new-harga_total_main-real');copy_to_harga_sub();count_harga_total_sub()"}),t("input",{type:"hidden",name:"harga_total_main",id:"barang_new-harga_total_main-real"})])]),t("tr",null,[t("td",null,"Satuan Sub"),t("td",null,[t("div",{class:"mx-1"},":")]),t("td",null,[t("input",{type:"text",name:"satuan_sub",class:"text-xs rounded p-1 w-3/4"})]),t("td",null,"Jumlah"),t("td",null,[t("div",{class:"mx-1"},":")]),t("td",null,[t("input",{type:"text",name:"jumlah_sub",id:"barang_new-jumlah_sub",class:"text-xs rounded p-1 w-3/4",oninput:"count_harga_total_sub()"})]),t("td",null,"Harga"),t("td",null,[t("div",{class:"mx-1"},":")]),t("td",null,[t("input",{type:"text",id:"barang_new-harga_sub",class:"text-xs rounded p-1",onchange:"formatNumber(this, 'barang_new-harga_sub-real');count_harga_total_sub()"}),t("input",{type:"hidden",name:"harga_sub",id:"barang_new-harga_sub-real"})]),t("td",null,"Harga Total"),t("td",null,[t("div",{class:"mx-1"},":")]),t("td",null,[t("input",{type:"text",name:"harga_total_sub",id:"barang_new-harga_total_sub",class:"text-xs rounded p-1",onchange:"formatNumber(this, 'barang_new-harga_total_sub-real');"}),t("input",{type:"hidden",name:"harga_total_sub",id:"barang_new-harga_total_sub-real"})])])])])])])]),t("tr",{class:"align-top"},[t("td",null,"Ket. (opt.)"),t("td",null,[t("div",{class:"mx-2"},":")]),t("td",{class:"py-1"},[t("textarea",{name:"keterangan",id:"",cols:"40",rows:"3",placeholder:"keterangan...",class:"rounded text-xs p-1"})])])])],-1),t("div",{class:"flex justify-center mt-3"},[t("button",{type:"submit",class:"border-2 border-indigo-300 bg-indigo-200 text-indigo-600 rounded-lg font-semibold py-1 px-3 hover:bg-indigo-300"},"+ Barang")],-1)]),32)])]),a[13]||(a[13]=t("div",{class:"grid"},[t("div",{class:"tabs tabs-lifted z-10 -mb-[var(--tab-border)] justify-self-start"},[t("button",{class:"tab tab-active [--tab-bg:var(--fallback-b1,oklch(var(--b1)]"},"Preview"),t("button",{class:"tab [--tab-border-color:transparent]"},"HTML"),t("button",{class:"tab [--tab-border-color:transparent]"},"JSX"),t("div",{class:"tab [--tab-border-color:transparent]"})]),t("div",{class:"bg-base-300 rounded-b-box rounded-se-box relative overflow-x-auto"},[t("div",{class:"preview border-base-300 bg-base-100 rounded-b-box rounded-se-box flex min-h-[6rem] min-w-[18rem] max-w-4xl flex-wrap items-center justify-center gap-2 overflow-x-hidden bg-cover bg-top p-4 [border-width:var(--tab-border)]",style:{}},[t("div",{class:"drawer h-56 rounded overflow-hidden"},[t("input",{id:"my-drawer",type:"checkbox",class:"drawer-toggle"}),t("div",{class:"flex flex-col items-center justify-center drawer-content"},[t("label",{for:"my-drawer",class:"btn btn-primary drawer-button"},"Open drawer")]),p(),t("div",{class:"drawer-side h-full absolute"},[t("label",{for:"my-drawer","aria-label":"close sidebar",class:"drawer-overlay"}),t("ul",{class:"menu p-4 w-60 md:w-80 min-h-full bg-base-200 text-base-content"},[t("li",null,[t("button",null,"Sidebar Item 1")]),t("li",null,[t("button",null,"Sidebar Item 2")])])])])])])],-1)),a[14]||(a[14]=t("div",{class:"collapse bg-base-200"},[t("input",{type:"checkbox"}),t("div",{class:"collapse-title text-xl font-medium"},"Click me to show/hide content"),t("div",{class:"collapse-content"},[t("p",null,"hello")])],-1)),b(B,{pembelians:l.pembelians,pembelian_barangs_all:l.pembelian_barangs_all,alamats:l.alamats,grand_total:l.grand_total,lunas_total:l.lunas_total,from:l.from,until:l.until},null,8,["pembelians","pembelian_barangs_all","alamats","grand_total","lunas_total","from","until"]),t("div",z,[a[11]||(a[11]=t("div",{class:"text-center mt-5"},"Preview: Print Out",-1)),t("div",C,[t("div",E,[t("table",F,[a[10]||(a[10]=t("thead",null,[t("tr",null,[t("th"),t("th"),t("th"),t("th"),t("th"),t("th"),t("th",null,"belum lunas"),t("th",null,"sudah lunas"),t("th",null,"grand total")])],-1)),t("tbody",null,[t("tr",null,[a[3]||(a[3]=t("td",null,null,-1)),a[4]||(a[4]=t("td",null,null,-1)),a[5]||(a[5]=t("td",null,null,-1)),a[6]||(a[6]=t("td",null,null,-1)),a[7]||(a[7]=t("td",null,null,-1)),a[8]||(a[8]=t("td",null,null,-1)),t("td",null,n(l.grand_total-l.lunas_total),1),t("td",null,n(l.lunas_total),1),t("td",null,n(l.grand_total),1)]),a[9]||(a[9]=t("tr",null,[t("th",null,"tanggal"),t("th",null,"supplier"),t("th",null,"nomor nota"),t("th",null,"nama barang"),t("th",null,"keterangan"),t("th",null,"jumlah sub"),t("th",null,"jumlah main"),t("th",null,"harga"),t("th",null,"harga total")],-1)),(r(!0),s(m,null,c(l.pembelians,(d,o)=>(r(),s(m,null,[(r(!0),s(m,null,c(l.pembelian_barangs_all[o],(e,U)=>(r(),s("tr",V,[t("td",null,n(d.created_at),1),l.alamats[o]?(r(),s("td",$,n(d.supplier_nama)+" - "+n(l.alamats[o].short),1)):(r(),s("td",L,n(d.supplier_nama),1)),t("td",null,n(d.nomor_nota),1),t("td",null,n(e.barang_nama),1),t("td",null,n(d.keterangan_bayar),1),t("td",null,n(e.jumlah_sub/100)+" "+n(e.satuan_sub),1),t("td",null,n(e.jumlah_main/100)+" "+n(e.satuan_main),1),t("td",null,n(e.harga_main),1),t("td",null,n(e.harga_t),1)]))),256))],64))),256))])])])]),a[12]||(a[12]=p(" // END - PRINT_OUT "))]),a[15]||(a[15]=t("div",{class:"w-56"},null,-1))])])]),_:1}))}};export{W as default};
