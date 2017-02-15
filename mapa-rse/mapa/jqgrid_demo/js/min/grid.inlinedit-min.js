/*
 * jqGrid extension for manipulating Grid Data
 * Tony Tomov tony@trirand.com
 * http://trirand.com/blog/ 
 */
;(function(a){a.fn.extend({editRow:function(i,s,j,u,o,v,t,w){return this.each(function(){var b=this,k,l,c,h=0,f=null,p=[],m;if(!b.grid){return}var r,q,x;if(!b.p.multiselect){m=a(b).getInd(b.rows,i);if(m===false){return}c=a(b.rows[m]).attr("editable")||"0";if(c=="0"){a('td',b.rows[m]).each(function(d){k=b.p.colModel[d].name;x=b.p.colModel[d].hidden===true?true:false;try{l=a.unformat(this,{colModel:b.p.colModel[d]},d)}catch(_){l=a.htmlDecode(a(this).html())}p[k]=l;if(k!=='cb'&&k!=='subgrid'&&b.p.colModel[d].editable===true&&!x){if(f===null){f=d}a(this).html("");var n=a.extend(b.p.colModel[d].editoptions||{},{id:i+"_"+k,name:k});if(!b.p.colModel[d].edittype){b.p.colModel[d].edittype="text"}var g=createEl(b.p.colModel[d].edittype,n,l,a(this));a(g).addClass("editable");a(this).append(g);if(b.p.colModel[d].edittype=="select"&&b.p.colModel[d].editoptions.multiple===true&&a.browser.msie){a(g).width(a(g).width())}h++}});if(h>0){p['id']=i;b.p.savedRow.push(p);a(b.rows[m]).attr("editable","1");a("td:eq("+f+") input",b.rows[m]).focus();if(s===true){a(b.rows[m]).bind("keydown",function(d){if(d.keyCode===27){a(b).restoreRow(i)}if(d.keyCode===13){a(b).saveRow(i,u,o,v,t,w);return false}d.stopPropagation()})}if(a.isFunction(j)){j(i)}}}}})},saveRow:function(j,u,o,v,t,w){return this.each(function(){var c=this,h,f={},p={},m,r,q,x,i;if(!c.grid){return}i=a(c).getInd(c.rows,j);if(i===false){return}m=a(c.rows[i]).attr("editable");o=o?o:c.p.editurl;if(m==="1"&&o){a("td",c.rows[i]).each(function(g){h=c.p.colModel[g].name;if(h!=='cb'&&h!=='subgrid'&&c.p.colModel[g].editable===true){if(c.p.colModel[g].hidden===true){f[h]=a(this).html()}else{switch(c.p.colModel[g].edittype){case"checkbox":var b=["Yes","No"];if(c.p.colModel[g].editoptions){b=c.p.colModel[g].editoptions.value.split(":")}f[h]=a("input",this).attr("checked")?b[0]:b[1];break;case'text':case'password':case'textarea':f[h]=htmlEncode(a("input, textarea",this).val());break;case'select':if(!c.p.colModel[g].editoptions.multiple){f[h]=a("select>option:selected",this).val();p[h]=a("select>option:selected",this).text()}else{var k=a("select",this);f[h]=a(k).val();var l=[];a("select > option:selected",this).each(function(d,n){l[d]=a(n).text()});p[h]=l.join(",")}break}q=checkValues(f[h],g,c);if(q[0]===false){q[1]=f[h]+" "+q[1];return false}}}});if(q[0]===false){try{info_dialog(a.jgrid.errors.errcap,q[1],a.jgrid.edit.bClose,c.p.imgpath)}catch(e){alert(q[1])}return}if(f){f["id"]=j;if(v){f=a.extend({},f,v)}}if(!c.grid.hDiv.loading){c.grid.hDiv.loading=true;a("div.loading",c.grid.hDiv).fadeIn("fast");if(o=='clientArray'){f=a.extend({},f,p);a(c).setRowData(j,f);a(c.rows[i]).attr("editable","0");for(var s=0;s<c.p.savedRow.length;s++){if(c.p.savedRow[s].id===j){r=s;break}}if(r>=0){c.p.savedRow.splice(r,1)}if(a.isFunction(t)){t(j,res.responseText)}}else{a.ajax({url:o,data:f,type:"POST",complete:function(d,n){if(n==="success"){var g;if(a.isFunction(u)){g=u(d)}else g=true;if(g===true){f=a.extend({},f,p);a(c).setRowData(j,f);a(c.rows[i]).attr("editable","0");for(var b=0;b<c.p.savedRow.length;b++){if(c.p.savedRow[b].id===j){r=b;break}};if(r>=0){c.p.savedRow.splice(r,1)}if(a.isFunction(t)){t(j,d.responseText)}}else{a(c).restoreRow(j)}}},error:function(d,n){if(a.isFunction(w)){w(d,n)}else{alert("Error Row: "+j+" Result: "+d.status+":"+d.statusText+" Status: "+n)}}})}c.grid.hDiv.loading=false;a("div.loading",c.grid.hDiv).fadeOut("fast");a(c.rows[i]).unbind("keydown")}}})},restoreRow:function(l){return this.each(function(){var d=this,n,g,b;if(!d.grid){return}b=a(d).getInd(d.rows,l);if(b===false){return}for(var k=0;k<d.p.savedRow.length;k++){if(d.p.savedRow[k].id===l){g=k;break}}if(g>=0){a(d).setRowData(l,d.p.savedRow[g]);a(d.rows[b]).attr("editable","0");d.p.savedRow.splice(g,1)}})}})})(jQuery);