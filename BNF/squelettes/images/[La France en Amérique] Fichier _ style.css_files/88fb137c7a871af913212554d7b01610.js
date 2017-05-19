/* compact [
	../plugins/auto/skeleditor/v2.7.11/codemirror/lib/codemirror.js
	../plugins/auto/skeleditor/v2.7.11/codemirror/mode/css/css.js
	../plugins/auto/skeleditor/v2.7.11/javascript/codemirror_init.js
] 67.1% */

/* ../plugins/auto/skeleditor/v2.7.11/codemirror/lib/codemirror.js */

var CodeMirror=(function(){
function CodeMirror(place,givenOptions){
var options={},defaults=CodeMirror.defaults;
for(var opt in defaults)
if(defaults.hasOwnProperty(opt))
options[opt]=(givenOptions&&givenOptions.hasOwnProperty(opt)?givenOptions:defaults)[opt];
var targetDocument=options["document"];
var wrapper=targetDocument.createElement("div");
wrapper.className="CodeMirror";
wrapper.innerHTML=
'<div style="overflow: hidden; position: relative; width: 1px; height: 0px;">'+
'<textarea style="position: absolute; width: 2px;" wrap="off"></textarea></div>'+
'<div class="CodeMirror-scroll cm-s-'+options.theme+'">'+
'<div style="position: relative">'+
'<div style="position: absolute; height: 0; width: 0; overflow: hidden;"></div>'+
'<div style="position: relative">'+
'<div class="CodeMirror-gutter"><div class="CodeMirror-gutter-text"></div></div>'+
'<div class="CodeMirror-lines"><div style="position: relative">'+
'<pre class="CodeMirror-cursor">&#160;</pre>'+
'<div></div>'+
'</div></div></div></div></div>';
if(place.appendChild)place.appendChild(wrapper);else place(wrapper);
var inputDiv=wrapper.firstChild,input=inputDiv.firstChild,
scroller=wrapper.lastChild,code=scroller.firstChild,
measure=code.firstChild,mover=measure.nextSibling,
gutter=mover.firstChild,gutterText=gutter.firstChild,
lineSpace=gutter.nextSibling.firstChild,
cursor=lineSpace.firstChild,lineDiv=cursor.nextSibling;
if(options.tabindex!=null)input.tabindex=options.tabindex;
if(!options.gutter&&!options.lineNumbers)gutter.style.display="none";
var poll=new Delayed(),highlight=new Delayed(),blinker;
var mode,lines=[new Line("")],work,history=new History(),focused;
loadMode();
var sel={from:{line:0,ch:0},to:{line:0,ch:0},inverted:false};
var shiftSelecting,reducedSelection,lastDoubleClick;
var updateInput,changes,textChanged,selectionChanged,leaveInputAlone;
var showingFrom=0,showingTo=0,lastHeight=0,curKeyId=null;
var editing,bracketHighlighted;
var maxLine="";
operation(function(){setValue(options.value||"");updateInput=false;})();
connect(scroller,"mousedown",operation(onMouseDown));
if(!gecko)connect(scroller,"contextmenu",onContextMenu);
connect(code,"dblclick",operation(onDblClick));
connect(scroller,"scroll",function(){updateDisplay([]);if(options.onScroll)options.onScroll(instance);});
connect(window,"resize",function(){updateDisplay(true);});
connect(input,"keyup",operation(onKeyUp));
connect(input,"keydown",operation(onKeyDown));
connect(input,"keypress",operation(onKeyPress));
connect(input,"focus",onFocus);
connect(input,"blur",onBlur);
connect(scroller,"dragenter",function(e){e.stop();});
connect(scroller,"dragover",function(e){e.stop();});
connect(scroller,"drop",operation(onDrop));
connect(scroller,"paste",function(){focusInput();fastPoll();});
connect(input,"paste",function(){fastPoll();});
connect(input,"cut",function(){fastPoll();});
var hasFocus;try{hasFocus=(targetDocument.activeElement==input);}catch(e){}
if(hasFocus)setTimeout(onFocus,20);
else onBlur();
function isLine(l){return l>=0&&l<lines.length;}
var instance={
getValue:getValue,
setValue:operation(setValue),
getSelection:getSelection,
replaceSelection:operation(replaceSelection),
focus:function(){focusInput();onFocus();fastPoll();},
setOption:function(option,value){
options[option]=value;
if(option=="lineNumbers"||option=="gutter")gutterChanged();
else if(option=="mode"||option=="indentUnit")loadMode();
else if(option=="readOnly"&&value=="nocursor")input.blur();
else if(option=="theme")scroller.className=scroller.className.replace(/cm-s-\w+/,"cm-s-"+value);
},
getOption:function(option){return options[option];},
undo:operation(undo),
redo:operation(redo),
indentLine:operation(function(n){if(isLine(n))indentLine(n,"smart");}),
historySize:function(){return{undo:history.done.length,redo:history.undone.length};},
matchBrackets:operation(function(){matchBrackets(true);}),
getTokenAt:function(pos){
pos=clipPos(pos);
return lines[pos.line].getTokenAt(mode,getStateBefore(pos.line),pos.ch);
},
getStateAfter:function(line){
line=clipLine(line==null?lines.length-1:line);
return getStateBefore(line+1);
},
cursorCoords:function(start){
if(start==null)start=sel.inverted;
return pageCoords(start?sel.from:sel.to);
},
charCoords:function(pos){return pageCoords(clipPos(pos));},
coordsChar:function(coords){
var off=eltOffset(lineSpace);
var line=clipLine(Math.min(lines.length-1,showingFrom+Math.floor((coords.y-off.top)/lineHeight())));
return clipPos({line:line,ch:charFromX(clipLine(line),coords.x-off.left)});
},
getSearchCursor:function(query,pos,caseFold){return new SearchCursor(query,pos,caseFold);},
markText:operation(function(a,b,c){return operation(markText(a,b,c));}),
setMarker:addGutterMarker,
clearMarker:removeGutterMarker,
setLineClass:operation(setLineClass),
lineInfo:lineInfo,
addWidget:function(pos,node,scroll,where){
pos=localCoords(clipPos(pos));
var top=pos.yBot,left=pos.x;
node.style.position="absolute";
code.appendChild(node);
node.style.left=left+"px";
if(where=="over")top=pos.y;
else if(where=="fit"){
var vspace=lines.length*lineHeight(),hspace=code.clientWidth-paddingLeft();
top=pos.y+node.offsetHeight>vspace?vspace-node.offsetHeight:pos.y;
if(left+node.offsetWidth>hspace)left=hspace-node.offsetWidth;
}
node.style.top=(top+paddingTop())+"px";
node.style.left=(left+paddingLeft())+"px";
if(scroll)
scrollIntoView(left,top,left+node.offsetWidth,top+node.offsetHeight);
},
lineCount:function(){return lines.length;},
getCursor:function(start){
if(start==null)start=sel.inverted;
return copyPos(start?sel.from:sel.to);
},
somethingSelected:function(){return!posEq(sel.from,sel.to);},
setCursor:operation(function(line,ch){
if(ch==null&&typeof line.line=="number")setCursor(line.line,line.ch);
else setCursor(line,ch);
}),
setSelection:operation(function(from,to){setSelection(clipPos(from),clipPos(to||from));}),
getLine:function(line){if(isLine(line))return lines[line].text;},
setLine:operation(function(line,text){
if(isLine(line))replaceRange(text,{line:line,ch:0},{line:line,ch:lines[line].text.length});
}),
removeLine:operation(function(line){
if(isLine(line))replaceRange("",{line:line,ch:0},clipPos({line:line+1,ch:0}));
}),
replaceRange:operation(replaceRange),
getRange:function(from,to){return getRange(clipPos(from),clipPos(to));},
operation:function(f){return operation(f)();},
refresh:function(){updateDisplay(true);},
getInputField:function(){return input;},
getWrapperElement:function(){return wrapper;},
getScrollerElement:function(){return scroller;}
};
function setValue(code){
history=null;
var top={line:0,ch:0};
updateLines(top,{line:lines.length-1,ch:lines[lines.length-1].text.length},
splitLines(code),top,top);
history=new History();
}
function getValue(code){
var text=[];
for(var i=0,l=lines.length;i<l;++i)
text.push(lines[i].text);
return text.join("\n");
}
function onMouseDown(e){
var ld=lastDoubleClick;lastDoubleClick=null;
for(var n=e.target();n!=wrapper;n=n.parentNode)
if(n.parentNode==gutterText){
if(options.onGutterClick)
options.onGutterClick(instance,indexOf(gutterText.childNodes,n)+showingFrom);
return e.stop();
}
var start=posFromMouse(e);
switch(e.button()){
case 3:
if(gecko&&!mac)onContextMenu(e);
return;
case 2:
if(start)setCursor(start.line,start.ch,true);
return;
}
if(!start){if(e.target()==scroller)e.stop();return;}
if(!focused)onFocus();
e.stop();
if(ld&&+new Date-ld<400)return selectLine(start.line);
setCursor(start.line,start.ch,true);
var last=start,going;
function end(){
focusInput();
updateInput=true;
move();up();
}
function extend(e){
var cur=posFromMouse(e,true);
if(cur&&!posEq(cur,last)){
if(!focused)onFocus();
last=cur;
setSelectionUser(start,cur);
updateInput=false;
var visible=visibleLines();
if(cur.line>=visible.to||cur.line<visible.from)
going=setTimeout(operation(function(){extend(e);}),150);
}
}
var move=connect(targetDocument,"mousemove",operation(function(e){
clearTimeout(going);
e.stop();
extend(e);
}),true);
var up=connect(targetDocument,"mouseup",operation(function(e){
clearTimeout(going);
var cur=posFromMouse(e);
if(cur)setSelectionUser(start,cur);
e.stop();
end();
}),true);
}
function onDblClick(e){
var pos=posFromMouse(e);
if(!pos)return;
selectWordAt(pos);
e.stop();
lastDoubleClick=+new Date;
}
function onDrop(e){
e.e.preventDefault();
var pos=posFromMouse(e,true),files=e.e.dataTransfer.files;
if(!pos||options.readOnly)return;
if(files&&files.length&&window.FileReader&&window.File){
function loadFile(file,i){
var reader=new FileReader;
reader.onload=function(){
text[i]=reader.result;
if(++read==n)replaceRange(text.join(""),clipPos(pos),clipPos(pos));
};
reader.readAsText(file);
}
var n=files.length,text=Array(n),read=0;
for(var i=0;i<n;++i)loadFile(files[i],i);
}
else{
try{
var text=e.e.dataTransfer.getData("Text");
if(text)replaceRange(text,pos,pos);
}
catch(e){}
}
}
function onKeyDown(e){
if(!focused)onFocus();
var code=e.e.keyCode;
if(ie&&code==27){e.e.returnValue=false;}
var mod=(mac?e.e.metaKey:e.e.ctrlKey)&&!e.e.altKey,anyMod=e.e.ctrlKey||e.e.altKey||e.e.metaKey;
if(code==16||e.e.shiftKey)shiftSelecting=shiftSelecting||(sel.inverted?sel.to:sel.from);
else shiftSelecting=null;
if(options.onKeyEvent&&options.onKeyEvent(instance,addStop(e.e)))return;
if(code==33||code==34){scrollPage(code==34);return e.stop();}
if(mod&&((code==36||code==35)||
mac&&(code==38||code==40))){
scrollEnd(code==36||code==38);return e.stop();
}
if(mod&&code==65){selectAll();return e.stop();}
if(!options.readOnly){
if(!anyMod&&code==13){return;}
if(!anyMod&&code==9&&handleTab(e.e.shiftKey))return e.stop();
if(mod&&code==90){undo();return e.stop();}
if(mod&&((e.e.shiftKey&&code==90)||code==89)){redo();return e.stop();}
}
curKeyId=(mod?"c":"")+code;
if(sel.inverted&&movementKeys.hasOwnProperty(curKeyId)){
var range=selRange(input);
if(range){
reducedSelection={anchor:range.start};
setSelRange(input,range.start,range.start);
}
}
fastPoll(curKeyId);
}
function onKeyUp(e){
if(options.onKeyEvent&&options.onKeyEvent(instance,addStop(e.e)))return;
if(reducedSelection){
reducedSelection=null;
updateInput=true;
}
if(e.e.keyCode==16)shiftSelecting=null;
}
function onKeyPress(e){
if(options.onKeyEvent&&options.onKeyEvent(instance,addStop(e.e)))return;
if(options.electricChars&&mode.electricChars){
var ch=String.fromCharCode(e.e.charCode==null?e.e.keyCode:e.e.charCode);
if(mode.electricChars.indexOf(ch)>-1)
setTimeout(operation(function(){indentLine(sel.to.line,"smart");}),50);
}
var code=e.e.keyCode;
if(code==13){if(!options.readOnly)handleEnter();e.stop();}
else if(!e.e.ctrlKey&&!e.e.altKey&&!e.e.metaKey&&code==9&&options.tabMode!="default")e.stop();
else fastPoll(curKeyId);
}
function onFocus(){
if(options.readOnly=="nocursor")return;
if(!focused){
if(options.onFocus)options.onFocus(instance);
focused=true;
if(wrapper.className.search(/\bCodeMirror-focused\b/)==-1)
wrapper.className+=" CodeMirror-focused";
if(!leaveInputAlone)prepareInput();
}
slowPoll();
restartBlink();
}
function onBlur(){
if(focused){
if(options.onBlur)options.onBlur(instance);
focused=false;
wrapper.className=wrapper.className.replace(" CodeMirror-focused","");
}
clearInterval(blinker);
setTimeout(function(){if(!focused)shiftSelecting=null;},150);
}
function updateLines(from,to,newText,selFrom,selTo){
if(history){
var old=[];
for(var i=from.line,e=to.line+1;i<e;++i)old.push(lines[i].text);
history.addChange(from.line,newText.length,old);
while(history.done.length>options.undoDepth)history.done.shift();
}
updateLinesNoUndo(from,to,newText,selFrom,selTo);
}
function unredoHelper(from,to){
var change=from.pop();
if(change){
var replaced=[],end=change.start+change.added;
for(var i=change.start;i<end;++i)replaced.push(lines[i].text);
to.push({start:change.start,added:change.old.length,old:replaced});
var pos=clipPos({line:change.start+change.old.length-1,
ch:editEnd(replaced[replaced.length-1],change.old[change.old.length-1])});
updateLinesNoUndo({line:change.start,ch:0},{line:end-1,ch:lines[end-1].text.length},change.old,pos,pos);
}
}
function undo(){unredoHelper(history.done,history.undone);}
function redo(){unredoHelper(history.undone,history.done);}
function updateLinesNoUndo(from,to,newText,selFrom,selTo){
var recomputeMaxLength=false,maxLineLength=maxLine.length;
for(var i=from.line;i<=to.line;++i){
if(lines[i].text.length==maxLineLength){recomputeMaxLength=true;break;}
}
var nlines=to.line-from.line,firstLine=lines[from.line],lastLine=lines[to.line];
if(firstLine==lastLine){
if(newText.length==1)
firstLine.replace(from.ch,to.ch,newText[0]);
else{
lastLine=firstLine.split(to.ch,newText[newText.length-1]);
var spliceargs=[from.line+1,nlines];
firstLine.replace(from.ch,firstLine.text.length,newText[0]);
for(var i=1,e=newText.length-1;i<e;++i)spliceargs.push(new Line(newText[i]));
spliceargs.push(lastLine);
lines.splice.apply(lines,spliceargs);
}
}
else if(newText.length==1){
firstLine.replace(from.ch,firstLine.text.length,newText[0]+lastLine.text.slice(to.ch));
lines.splice(from.line+1,nlines);
}
else{
var spliceargs=[from.line+1,nlines-1];
firstLine.replace(from.ch,firstLine.text.length,newText[0]);
lastLine.replace(0,to.ch,newText[newText.length-1]);
for(var i=1,e=newText.length-1;i<e;++i)spliceargs.push(new Line(newText[i]));
lines.splice.apply(lines,spliceargs);
}
for(var i=from.line,e=i+newText.length;i<e;++i){
var l=lines[i].text;
if(l.length>maxLineLength){
maxLine=l;maxLineLength=l.length;
recomputeMaxLength=false;
}
}
if(recomputeMaxLength){
maxLineLength=0;maxLine="";
for(var i=0,e=lines.length;i<e;++i){
var l=lines[i].text;
if(l.length>maxLineLength){
maxLineLength=l.length;maxLine=l;
}
}
}
var newWork=[],lendiff=newText.length-nlines-1;
for(var i=0,l=work.length;i<l;++i){
var task=work[i];
if(task<from.line)newWork.push(task);
else if(task>to.line)newWork.push(task+lendiff);
}
if(newText.length<5){
highlightLines(from.line,from.line+newText.length);
newWork.push(from.line+newText.length);
}else{
newWork.push(from.line);
}
work=newWork;
startWorker(100);
changes.push({from:from.line,to:to.line+1,diff:lendiff});
textChanged={from:from,to:to,text:newText};
function updateLine(n){return n<=Math.min(to.line,to.line+lendiff)?n:n+lendiff;}
setSelection(selFrom,selTo,updateLine(sel.from.line),updateLine(sel.to.line));
code.style.height=(lines.length*lineHeight()+2*paddingTop())+"px";
}
function replaceRange(code,from,to){
from=clipPos(from);
if(!to)to=from;else to=clipPos(to);
code=splitLines(code);
function adjustPos(pos){
if(posLess(pos,from))return pos;
if(!posLess(to,pos))return end;
var line=pos.line+code.length-(to.line-from.line)-1;
var ch=pos.ch;
if(pos.line==to.line)
ch+=code[code.length-1].length-(to.ch-(to.line==from.line?from.ch:0));
return{line:line,ch:ch};
}
var end;
replaceRange1(code,from,to,function(end1){
end=end1;
return{from:adjustPos(sel.from),to:adjustPos(sel.to)};
});
return end;
}
function replaceSelection(code,collapse){
replaceRange1(splitLines(code),sel.from,sel.to,function(end){
if(collapse=="end")return{from:end,to:end};
else if(collapse=="start")return{from:sel.from,to:sel.from};
else return{from:sel.from,to:end};
});
}
function replaceRange1(code,from,to,computeSel){
var endch=code.length==1?code[0].length+from.ch:code[code.length-1].length;
var newSel=computeSel({line:from.line+code.length-1,ch:endch});
updateLines(from,to,code,newSel.from,newSel.to);
}
function getRange(from,to){
var l1=from.line,l2=to.line;
if(l1==l2)return lines[l1].text.slice(from.ch,to.ch);
var code=[lines[l1].text.slice(from.ch)];
for(var i=l1+1;i<l2;++i)code.push(lines[i].text);
code.push(lines[l2].text.slice(0,to.ch));
return code.join("\n");
}
function getSelection(){
return getRange(sel.from,sel.to);
}
var pollingFast=false;
function slowPoll(){
if(pollingFast)return;
poll.set(2000,function(){
startOperation();
readInput();
if(focused)slowPoll();
endOperation();
});
}
function fastPoll(keyId){
var missed=false;
pollingFast=true;
function p(){
startOperation();
var changed=readInput();
if(changed=="moved"&&keyId)movementKeys[keyId]=true;
if(!changed&&!missed){missed=true;poll.set(80,p);}
else{pollingFast=false;slowPoll();}
endOperation();
}
poll.set(20,p);
}
function readInput(){
if(leaveInputAlone)return;
var changed=false,text=input.value,sr=selRange(input);
if(!sr)return false;
var changed=editing.text!=text,rs=reducedSelection;
var moved=changed||sr.start!=editing.start||sr.end!=(rs?editing.start:editing.end);
if(!moved&&!rs)return false;
if(changed){
shiftSelecting=reducedSelection=null;
if(options.readOnly){updateInput=true;return"changed";}
}
function computeOffset(n,startLine){
var pos=0;
for(;;){
var found=text.indexOf("\n",pos);
if(found==-1||(text.charAt(found-1)=="\r"?found-1:found)>=n)
return{line:startLine,ch:n-pos};
++startLine;
pos=found+1;
}
}
var from=computeOffset(sr.start,editing.from),
to=computeOffset(sr.end,editing.from);
if(rs){
var head=sr.start==rs.anchor?to:from;
var tail=shiftSelecting?sel.to:sr.start==rs.anchor?from:to;
if(sel.inverted=posLess(head,tail)){from=head;to=tail;}
else{reducedSelection=null;from=tail;to=head;}
}
if(from.line==to.line&&from.line==sel.from.line&&from.line==sel.to.line&&!shiftSelecting)
updateInput=false;
if(changed){
var start=0,end=text.length,len=Math.min(end,editing.text.length);
var c,line=editing.from,nl=-1;
while(start<len&&(c=text.charAt(start))==editing.text.charAt(start)){
++start;
if(c=="\n"){line++;nl=start;}
}
var ch=nl>-1?start-nl:start,endline=editing.to-1,edend=editing.text.length;
for(;;){
c=editing.text.charAt(edend);
if(text.charAt(end)!=c){++end;++edend;break;}
if(c=="\n")endline--;
if(edend<=start||end<=start)break;
--end;--edend;
}
var nl=editing.text.lastIndexOf("\n",edend-1),endch=nl==-1?edend:edend-nl-1;
updateLines({line:line,ch:ch},{line:endline,ch:endch},splitLines(text.slice(start,end)),from,to);
if(line!=endline||from.line!=line)updateInput=true;
}
else setSelection(from,to);
editing.text=text;editing.start=sr.start;editing.end=sr.end;
return changed?"changed":moved?"moved":false;
}
function prepareInput(){
var text=[];
var from=Math.max(0,sel.from.line-1),to=Math.min(lines.length,sel.to.line+2);
for(var i=from;i<to;++i)text.push(lines[i].text);
text=input.value=text.join(lineSep);
var startch=sel.from.ch,endch=sel.to.ch;
for(var i=from;i<sel.from.line;++i)
startch+=lineSep.length+lines[i].text.length;
for(var i=from;i<sel.to.line;++i)
endch+=lineSep.length+lines[i].text.length;
editing={text:text,from:from,to:to,start:startch,end:endch};
setSelRange(input,startch,reducedSelection?startch:endch);
}
function focusInput(){
if(options.readOnly!="nocursor")input.focus();
}
function scrollCursorIntoView(){
var cursor=localCoords(sel.inverted?sel.from:sel.to);
return scrollIntoView(cursor.x,cursor.y,cursor.x,cursor.yBot);
}
function scrollIntoView(x1,y1,x2,y2){
var pl=paddingLeft(),pt=paddingTop(),lh=lineHeight();
y1+=pt;y2+=pt;x1+=pl;x2+=pl;
var screen=scroller.clientHeight,screentop=scroller.scrollTop,scrolled=false,result=true;
if(y1<screentop){scroller.scrollTop=Math.max(0,y1-2*lh);scrolled=true;}
else if(y2>screentop+screen){scroller.scrollTop=y2+lh-screen;scrolled=true;}
var screenw=scroller.clientWidth,screenleft=scroller.scrollLeft;
if(x1<screenleft){
if(x1<50)x1=0;
scroller.scrollLeft=Math.max(0,x1-10);
scrolled=true;
}
else if(x2>screenw+screenleft){
scroller.scrollLeft=x2+10-screenw;
scrolled=true;
if(x2>code.clientWidth)result=false;
}
if(scrolled&&options.onScroll)options.onScroll(instance);
return result;
}
function visibleLines(){
var lh=lineHeight(),top=scroller.scrollTop-paddingTop();
return{from:Math.min(lines.length,Math.max(0,Math.floor(top/lh))),
to:Math.min(lines.length,Math.ceil((top+scroller.clientHeight)/lh))};
}
function updateDisplay(changes){
if(!scroller.clientWidth){
showingFrom=showingTo=0;
return;
}
var intact=changes===true?[]:[{from:showingFrom,to:showingTo,domStart:0}];
for(var i=0,l=changes.length||0;i<l;++i){
var change=changes[i],intact2=[],diff=change.diff||0;
for(var j=0,l2=intact.length;j<l2;++j){
var range=intact[j];
if(change.to<=range.from)
intact2.push({from:range.from+diff,to:range.to+diff,domStart:range.domStart});
else if(range.to<=change.from)
intact2.push(range);
else{
if(change.from>range.from)
intact2.push({from:range.from,to:change.from,domStart:range.domStart})
if(change.to<range.to)
intact2.push({from:change.to+diff,to:range.to+diff,
domStart:range.domStart+(change.to-range.from)});
}
}
intact=intact2;
}
var visible=visibleLines();
var from=Math.min(showingFrom,Math.max(visible.from-3,0)),
to=Math.min(lines.length,Math.max(showingTo,visible.to+3)),
updates=[],domPos=0,domEnd=showingTo-showingFrom,pos=from,changedLines=0;
for(var i=0,l=intact.length;i<l;++i){
var range=intact[i];
if(range.to<=from)continue;
if(range.from>=to)break;
if(range.domStart>domPos||range.from>pos){
updates.push({from:pos,to:range.from,domSize:range.domStart-domPos,domStart:domPos});
changedLines+=range.from-pos;
}
pos=range.to;
domPos=range.domStart+(range.to-range.from);
}
if(domPos!=domEnd||pos!=to){
changedLines+=Math.abs(to-pos);
updates.push({from:pos,to:to,domSize:domEnd-domPos,domStart:domPos});
}
if(!updates.length)return;
lineDiv.style.display="none";
if(changedLines>(visible.to-visible.from)*.3)
refreshDisplay(from=Math.max(visible.from-10,0),to=Math.min(visible.to+7,lines.length));
else
patchDisplay(updates);
lineDiv.style.display="";
var different=from!=showingFrom||to!=showingTo||lastHeight!=scroller.clientHeight;
showingFrom=from;showingTo=to;
mover.style.top=(from*lineHeight())+"px";
if(different){
lastHeight=scroller.clientHeight;
code.style.height=(lines.length*lineHeight()+2*paddingTop())+"px";
updateGutter();
}
var textWidth=stringWidth(maxLine);
lineSpace.style.width=textWidth>scroller.clientWidth?textWidth+"px":"";
code.style.width=(lineSpace.offsetWidth+lineSpace.offsetLeft)+"px";
if(lineDiv.childNodes.length!=showingTo-showingFrom)
throw new Error("BAD PATCH! "+JSON.stringify(updates)+" size="+(showingTo-showingFrom)+
" nodes="+lineDiv.childNodes.length);
updateCursor();
}
function refreshDisplay(from,to){
var html=[],start={line:from,ch:0},inSel=posLess(sel.from,start)&&!posLess(sel.to,start);
for(var i=from;i<to;++i){
var ch1=null,ch2=null;
if(inSel){
ch1=0;
if(sel.to.line==i){inSel=false;ch2=sel.to.ch;}
}
else if(sel.from.line==i){
if(sel.to.line==i){ch1=sel.from.ch;ch2=sel.to.ch;}
else{inSel=true;ch1=sel.from.ch;}
}
html.push(lines[i].getHTML(ch1,ch2,true));
}
lineDiv.innerHTML=html.join("");
}
function patchDisplay(updates){
var sfrom=sel.from.line,sto=sel.to.line,off=0,
scratch=badInnerHTML&&targetDocument.createElement("div");
for(var i=0,e=updates.length;i<e;++i){
var rec=updates[i];
var extra=(rec.to-rec.from)-rec.domSize;
var nodeAfter=lineDiv.childNodes[rec.domStart+rec.domSize+off]||null;
if(badInnerHTML)
for(var j=Math.max(-extra,rec.domSize);j>0;--j)
lineDiv.removeChild(nodeAfter?nodeAfter.previousSibling:lineDiv.lastChild);
else if(extra){
for(var j=Math.max(0,extra);j>0;--j)
lineDiv.insertBefore(targetDocument.createElement("pre"),nodeAfter);
for(var j=Math.max(0,-extra);j>0;--j)
lineDiv.removeChild(nodeAfter?nodeAfter.previousSibling:lineDiv.lastChild);
}
var node=lineDiv.childNodes[rec.domStart+off],inSel=sfrom<rec.from&&sto>=rec.from;
for(var j=rec.from;j<rec.to;++j){
var ch1=null,ch2=null;
if(inSel){
ch1=0;
if(sto==j){inSel=false;ch2=sel.to.ch;}
}
else if(sfrom==j){
if(sto==j){ch1=sel.from.ch;ch2=sel.to.ch;}
else{inSel=true;ch1=sel.from.ch;}
}
if(badInnerHTML){
scratch.innerHTML=lines[j].getHTML(ch1,ch2,true);
lineDiv.insertBefore(scratch.firstChild,nodeAfter);
}
else{
node.innerHTML=lines[j].getHTML(ch1,ch2,false);
node.className=lines[j].className||"";
node=node.nextSibling;
}
}
off+=extra;
}
}
function updateGutter(){
if(!options.gutter&&!options.lineNumbers)return;
var hText=mover.offsetHeight,hEditor=scroller.clientHeight;
gutter.style.height=(hText-hEditor<2?hEditor:hText)+"px";
var html=[];
for(var i=showingFrom;i<Math.max(showingTo,showingFrom+1);++i){
var marker=lines[i].gutterMarker;
var text=options.lineNumbers?i+options.firstLineNumber:null;
if(marker&&marker.text)
text=marker.text.replace("%N%",text!=null?text:"");
else if(text==null)
text="\u00a0";
html.push((marker&&marker.style?'<pre class="'+marker.style+'">':"<pre>"),text,"</pre>");
}
gutter.style.display="none";
gutterText.innerHTML=html.join("");
var minwidth=String(lines.length).length,firstNode=gutterText.firstChild,val=eltText(firstNode),pad="";
while(val.length+pad.length<minwidth)pad+="\u00a0";
if(pad)firstNode.insertBefore(targetDocument.createTextNode(pad),firstNode.firstChild);
gutter.style.display="";
lineSpace.style.marginLeft=gutter.offsetWidth+"px";
}
function updateCursor(){
var head=sel.inverted?sel.from:sel.to,lh=lineHeight();
var x=charX(head.line,head.ch)+"px",y=(head.line-showingFrom)*lh+"px";
inputDiv.style.top=(head.line*lh-scroller.scrollTop)+"px";
if(posEq(sel.from,sel.to)){
cursor.style.top=y;cursor.style.left=x;
cursor.style.display="";
}
else cursor.style.display="none";
}
function setSelectionUser(from,to){
var sh=shiftSelecting&&clipPos(shiftSelecting);
if(sh){
if(posLess(sh,from))from=sh;
else if(posLess(to,sh))to=sh;
}
setSelection(from,to);
}
function setSelection(from,to,oldFrom,oldTo){
if(posEq(sel.from,from)&&posEq(sel.to,to))return;
if(posLess(to,from)){var tmp=to;to=from;from=tmp;}
if(posEq(from,to))sel.inverted=false;
else if(posEq(from,sel.to))sel.inverted=false;
else if(posEq(to,sel.from))sel.inverted=true;
if(oldFrom==null){oldFrom=sel.from.line;oldTo=sel.to.line;}
if(posEq(from,to)){
if(!posEq(sel.from,sel.to))
changes.push({from:oldFrom,to:oldTo+1});
}
else if(posEq(sel.from,sel.to)){
changes.push({from:from.line,to:to.line+1});
}
else{
if(!posEq(from,sel.from)){
if(from.line<oldFrom)
changes.push({from:from.line,to:Math.min(to.line,oldFrom)+1});
else
changes.push({from:oldFrom,to:Math.min(oldTo,from.line)+1});
}
if(!posEq(to,sel.to)){
if(to.line<oldTo)
changes.push({from:Math.max(oldFrom,from.line),to:oldTo+1});
else
changes.push({from:Math.max(from.line,oldTo),to:to.line+1});
}
}
sel.from=from;sel.to=to;
selectionChanged=true;
}
function setCursor(line,ch,user){
var pos=clipPos({line:line,ch:ch||0});
(user?setSelectionUser:setSelection)(pos,pos);
}
function clipLine(n){return Math.max(0,Math.min(n,lines.length-1));}
function clipPos(pos){
if(pos.line<0)return{line:0,ch:0};
if(pos.line>=lines.length)return{line:lines.length-1,ch:lines[lines.length-1].text.length};
var ch=pos.ch,linelen=lines[pos.line].text.length;
if(ch==null||ch>linelen)return{line:pos.line,ch:linelen};
else if(ch<0)return{line:pos.line,ch:0};
else return pos;
}
function scrollPage(down){
var linesPerPage=Math.floor(scroller.clientHeight/lineHeight()),head=sel.inverted?sel.from:sel.to;
setCursor(head.line+(Math.max(linesPerPage-1,1)*(down?1:-1)),head.ch,true);
}
function scrollEnd(top){
var pos=top?{line:0,ch:0}:{line:lines.length-1,ch:lines[lines.length-1].text.length};
setSelectionUser(pos,pos);
}
function selectAll(){
var endLine=lines.length-1;
setSelection({line:0,ch:0},{line:endLine,ch:lines[endLine].text.length});
}
function selectWordAt(pos){
var line=lines[pos.line].text;
var start=pos.ch,end=pos.ch;
while(start>0&&/\w/.test(line.charAt(start-1)))--start;
while(end<line.length&&/\w/.test(line.charAt(end)))++end;
setSelectionUser({line:pos.line,ch:start},{line:pos.line,ch:end});
}
function selectLine(line){
setSelectionUser({line:line,ch:0},{line:line,ch:lines[line].text.length});
}
function handleEnter(){
replaceSelection("\n","end");
if(options.enterMode!="flat")
indentLine(sel.from.line,options.enterMode=="keep"?"prev":"smart");
}
function handleTab(shift){
function indentSelected(mode){
if(posEq(sel.from,sel.to))return indentLine(sel.from.line,mode);
var e=sel.to.line-(sel.to.ch?1:0);
for(var i=sel.from.line;i<e;++i)indentLine(i,mode);
}
shiftSelecting=null;
switch(options.tabMode){
case"default":
return false;
case"indent":
indentSelected("smart");
break;
case"classic":
if(posEq(sel.from,sel.to)){
if(shift)indentLine(sel.from.line,"smart");
else replaceSelection("\t","end");
break;
}
case"shift":
indentSelected(shift?"subtract":"add");
break;
}
return true;
}
function indentLine(n,how){
if(how=="smart"){
if(!mode.indent)how="prev";
else var state=getStateBefore(n);
}
var line=lines[n],curSpace=line.indentation(),curSpaceString=line.text.match(/^\s*/)[0],indentation;
if(how=="prev"){
if(n)indentation=lines[n-1].indentation();
else indentation=0;
}
else if(how=="smart")indentation=mode.indent(state,line.text.slice(curSpaceString.length));
else if(how=="add")indentation=curSpace+options.indentUnit;
else if(how=="subtract")indentation=curSpace-options.indentUnit;
indentation=Math.max(0,indentation);
var diff=indentation-curSpace;
if(!diff){
if(sel.from.line!=n&&sel.to.line!=n)return;
var indentString=curSpaceString;
}
else{
var indentString="",pos=0;
if(options.indentWithTabs)
for(var i=Math.floor(indentation/tabSize);i;--i){pos+=tabSize;indentString+="\t";}
while(pos<indentation){++pos;indentString+=" ";}
}
replaceRange(indentString,{line:n,ch:0},{line:n,ch:curSpaceString.length});
}
function loadMode(){
mode=CodeMirror.getMode(options,options.mode);
for(var i=0,l=lines.length;i<l;++i)
lines[i].stateAfter=null;
work=[0];
startWorker();
}
function gutterChanged(){
var visible=options.gutter||options.lineNumbers;
gutter.style.display=visible?"":"none";
if(visible)updateGutter();
else lineDiv.parentNode.style.marginLeft=0;
}
function markText(from,to,className){
from=clipPos(from);to=clipPos(to);
var accum=[];
function add(line,from,to,className){
var line=lines[line],mark=line.addMark(from,to,className);
mark.line=line;
accum.push(mark);
}
if(from.line==to.line)add(from.line,from.ch,to.ch,className);
else{
add(from.line,from.ch,null,className);
for(var i=from.line+1,e=to.line;i<e;++i)
add(i,0,null,className);
add(to.line,0,to.ch,className);
}
changes.push({from:from.line,to:to.line+1});
return function(){
var start,end;
for(var i=0;i<accum.length;++i){
var mark=accum[i],found=indexOf(lines,mark.line);
mark.line.removeMark(mark);
if(found>-1){
if(start==null)start=found;
end=found;
}
}
if(start!=null)changes.push({from:start,to:end+1});
};
}
function addGutterMarker(line,text,className){
if(typeof line=="number")line=lines[clipLine(line)];
line.gutterMarker={text:text,style:className};
updateGutter();
return line;
}
function removeGutterMarker(line){
if(typeof line=="number")line=lines[clipLine(line)];
line.gutterMarker=null;
updateGutter();
}
function setLineClass(line,className){
if(typeof line=="number"){
var no=line;
line=lines[clipLine(line)];
}
else{
var no=indexOf(lines,line);
if(no==-1)return null;
}
if(line.className!=className){
line.className=className;
changes.push({from:no,to:no+1});
}
return line;
}
function lineInfo(line){
if(typeof line=="number"){
var n=line;
line=lines[line];
if(!line)return null;
}
else{
var n=indexOf(lines,line);
if(n==-1)return null;
}
var marker=line.gutterMarker;
return{line:n,text:line.text,markerText:marker&&marker.text,markerClass:marker&&marker.style};
}
function stringWidth(str){
measure.innerHTML="<pre><span>x</span></pre>";
measure.firstChild.firstChild.firstChild.nodeValue=str;
return measure.firstChild.firstChild.offsetWidth||10;
}
function charX(line,pos){
if(pos==0)return 0;
measure.innerHTML="<pre><span>"+lines[line].getHTML(null,null,false,pos)+"</span></pre>";
return measure.firstChild.firstChild.offsetWidth;
}
function charFromX(line,x){
if(x<=0)return 0;
var lineObj=lines[line],text=lineObj.text;
function getX(len){
measure.innerHTML="<pre><span>"+lineObj.getHTML(null,null,false,len)+"</span></pre>";
return measure.firstChild.firstChild.offsetWidth;
}
var from=0,fromX=0,to=text.length,toX;
var estimated=Math.min(to,Math.ceil(x/stringWidth("x")));
for(;;){
var estX=getX(estimated);
if(estX<=x&&estimated<to)estimated=Math.min(to,Math.ceil(estimated*1.2));
else{toX=estX;to=estimated;break;}
}
if(x>toX)return to;
estimated=Math.floor(to*0.8);estX=getX(estimated);
if(estX<x){from=estimated;fromX=estX;}
for(;;){
if(to-from<=1)return(toX-x>x-fromX)?from:to;
var middle=Math.ceil((from+to)/2),middleX=getX(middle);
if(middleX>x){to=middle;toX=middleX;}
else{from=middle;fromX=middleX;}
}
}
function localCoords(pos,inLineWrap){
var lh=lineHeight(),line=pos.line-(inLineWrap?showingFrom:0);
return{x:charX(pos.line,pos.ch),y:line*lh,yBot:(line+1)*lh};
}
function pageCoords(pos){
var local=localCoords(pos,true),off=eltOffset(lineSpace);
return{x:off.left+local.x,y:off.top+local.y,yBot:off.top+local.yBot};
}
function lineHeight(){
var nlines=lineDiv.childNodes.length;
if(nlines)return(lineDiv.offsetHeight/nlines)||1;
measure.innerHTML="<pre>x</pre>";
return measure.firstChild.offsetHeight||1;
}
function paddingTop(){return lineSpace.offsetTop;}
function paddingLeft(){return lineSpace.offsetLeft;}
function posFromMouse(e,liberal){
var offW=eltOffset(scroller,true),x,y;
try{x=e.e.clientX;y=e.e.clientY;}catch(e){return null;}
if(!liberal&&(x-offW.left>scroller.clientWidth||y-offW.top>scroller.clientHeight))
return null;
var offL=eltOffset(lineSpace,true);
var line=showingFrom+Math.floor((y-offL.top)/lineHeight());
return clipPos({line:line,ch:charFromX(clipLine(line),x-offL.left)});
}
function onContextMenu(e){
var pos=posFromMouse(e);
if(!pos||window.opera)return;
if(posEq(sel.from,sel.to)||posLess(pos,sel.from)||!posLess(pos,sel.to))
operation(setCursor)(pos.line,pos.ch);
var oldCSS=input.style.cssText;
inputDiv.style.position="absolute";
input.style.cssText="position: fixed; width: 30px; height: 30px; top: "+(e.pageY()-1)+
"px; left: "+(e.pageX()-1)+"px; z-index: 1000; background: white; "+
"border-width: 0; outline: none; overflow: hidden; opacity: .05; filter: alpha(opacity=5);";
leaveInputAlone=true;
var val=input.value=getSelection();
focusInput();
setSelRange(input,0,input.value.length);
function rehide(){
var newVal=splitLines(input.value).join("\n");
if(newVal!=val)operation(replaceSelection)(newVal,"end");
inputDiv.style.position="relative";
input.style.cssText=oldCSS;
leaveInputAlone=false;
prepareInput();
slowPoll();
}
if(gecko){
e.stop();
var mouseup=connect(window,"mouseup",function(){
mouseup();
setTimeout(rehide,20);
},true);
}
else{
setTimeout(rehide,50);
}
}
function restartBlink(){
clearInterval(blinker);
var on=true;
cursor.style.visibility="";
blinker=setInterval(function(){
cursor.style.visibility=(on=!on)?"":"hidden";
},650);
}
var matching={"(":")>",")":"(<","[":"]>","]":"[<","{":"}>","}":"{<"};
function matchBrackets(autoclear){
var head=sel.inverted?sel.from:sel.to,line=lines[head.line],pos=head.ch-1;
var match=(pos>=0&&matching[line.text.charAt(pos)])||matching[line.text.charAt(++pos)];
if(!match)return;
var ch=match.charAt(0),forward=match.charAt(1)==">",d=forward?1:-1,st=line.styles;
for(var off=pos+1,i=0,e=st.length;i<e;i+=2)
if((off-=st[i].length)<=0){var style=st[i+1];break;}
var stack=[line.text.charAt(pos)],re=/[(){}[\]]/;
function scan(line,from,to){
if(!line.text)return;
var st=line.styles,pos=forward?0:line.text.length-1,cur;
for(var i=forward?0:st.length-2,e=forward?st.length:-2;i!=e;i+=2*d){
var text=st[i];
if(st[i+1]!=null&&st[i+1]!=style){pos+=d*text.length;continue;}
for(var j=forward?0:text.length-1,te=forward?text.length:-1;j!=te;j+=d,pos+=d){
if(pos>=from&&pos<to&&re.test(cur=text.charAt(j))){
var match=matching[cur];
if(match.charAt(1)==">"==forward)stack.push(cur);
else if(stack.pop()!=match.charAt(0))return{pos:pos,match:false};
else if(!stack.length)return{pos:pos,match:true};
}
}
}
}
for(var i=head.line,e=forward?Math.min(i+100,lines.length):Math.max(-1,i-100);i!=e;i+=d){
var line=lines[i],first=i==head.line;
var found=scan(line,first&&forward?pos+1:0,first&&!forward?pos:line.text.length);
if(found)break;
}
if(!found)found={pos:null,match:false};
var style=found.match?"CodeMirror-matchingbracket":"CodeMirror-nonmatchingbracket";
var one=markText({line:head.line,ch:pos},{line:head.line,ch:pos+1},style),
two=found.pos!=null
?markText({line:i,ch:found.pos},{line:i,ch:found.pos+1},style)
:function(){};
var clear=operation(function(){one();two();});
if(autoclear)setTimeout(clear,800);
else bracketHighlighted=clear;
}
function findStartLine(n){
var minindent,minline;
for(var search=n,lim=n-40;search>lim;--search){
if(search==0)return 0;
var line=lines[search-1];
if(line.stateAfter)return search;
var indented=line.indentation();
if(minline==null||minindent>indented){
minline=search;
minindent=indented;
}
}
return minline;
}
function getStateBefore(n){
var start=findStartLine(n),state=start&&lines[start-1].stateAfter;
if(!state)state=startState(mode);
else state=copyState(mode,state);
for(var i=start;i<n;++i){
var line=lines[i];
line.highlight(mode,state);
line.stateAfter=copyState(mode,state);
}
if(!lines[n].stateAfter)work.push(n);
return state;
}
function highlightLines(start,end){
var state=getStateBefore(start);
for(var i=start;i<end;++i){
var line=lines[i];
line.highlight(mode,state);
line.stateAfter=copyState(mode,state);
}
}
function highlightWorker(){
var end=+new Date+options.workTime;
var foundWork=work.length;
while(work.length){
if(!lines[showingFrom].stateAfter)var task=showingFrom;
else var task=work.pop();
if(task>=lines.length)continue;
var start=findStartLine(task),state=start&&lines[start-1].stateAfter;
if(state)state=copyState(mode,state);
else state=startState(mode);
var unchanged=0,compare=mode.compareStates;
for(var i=start,l=lines.length;i<l;++i){
var line=lines[i],hadState=line.stateAfter;
if(+new Date>end){
work.push(i);
startWorker(options.workDelay);
changes.push({from:task,to:i});
return;
}
var changed=line.highlight(mode,state);
line.stateAfter=copyState(mode,state);
if(compare){
if(hadState&&compare(hadState,state))break;
}else{
if(changed||!hadState)unchanged=0;
else if(++unchanged>3)break;
}
}
changes.push({from:task,to:i});
}
if(foundWork&&options.onHighlightComplete)
options.onHighlightComplete(instance);
}
function startWorker(time){
if(!work.length)return;
highlight.set(time,operation(highlightWorker));
}
function startOperation(){
updateInput=null;changes=[];textChanged=selectionChanged=false;
}
function endOperation(){
var reScroll=false;
if(selectionChanged)reScroll=!scrollCursorIntoView();
if(changes.length)updateDisplay(changes);
else if(selectionChanged)updateCursor();
if(reScroll)scrollCursorIntoView();
if(selectionChanged)restartBlink();
if(focused&&!leaveInputAlone&&
(updateInput===true||(updateInput!==false&&selectionChanged)))
prepareInput();
if(selectionChanged&&options.matchBrackets)
setTimeout(operation(function(){
if(bracketHighlighted){bracketHighlighted();bracketHighlighted=null;}
matchBrackets(false);
}),20);
var tc=textChanged;
if(selectionChanged&&options.onCursorActivity)
options.onCursorActivity(instance);
if(tc&&options.onChange&&instance)
options.onChange(instance,tc);
}
var nestedOperation=0;
function operation(f){
return function(){
if(!nestedOperation++)startOperation();
try{var result=f.apply(this,arguments);}
finally{if(!--nestedOperation)endOperation();}
return result;
};
}
function SearchCursor(query,pos,caseFold){
this.atOccurrence=false;
if(caseFold==null)caseFold=typeof query=="string"&&query==query.toLowerCase();
if(pos&&typeof pos=="object")pos=clipPos(pos);
else pos={line:0,ch:0};
this.pos={from:pos,to:pos};
if(typeof query!="string")
this.matches=function(reverse,pos){
if(reverse){
var line=lines[pos.line].text.slice(0,pos.ch),match=line.match(query),start=0;
while(match){
var ind=line.indexOf(match[0]);
start+=ind;
line=line.slice(ind+1);
var newmatch=line.match(query);
if(newmatch)match=newmatch;
else break;
start++;
}
}
else{
var line=lines[pos.line].text.slice(pos.ch),match=line.match(query),
start=match&&pos.ch+line.indexOf(match[0]);
}
if(match)
return{from:{line:pos.line,ch:start},
to:{line:pos.line,ch:start+match[0].length},
match:match};
};
else{
if(caseFold)query=query.toLowerCase();
var fold=caseFold?function(str){return str.toLowerCase();}:function(str){return str;};
var target=query.split("\n");
if(target.length==1)
this.matches=function(reverse,pos){
var line=fold(lines[pos.line].text),len=query.length,match;
if(reverse?(pos.ch>=len&&(match=line.lastIndexOf(query,pos.ch-len))!=-1)
:(match=line.indexOf(query,pos.ch))!=-1)
return{from:{line:pos.line,ch:match},
to:{line:pos.line,ch:match+len}};
};
else
this.matches=function(reverse,pos){
var ln=pos.line,idx=(reverse?target.length-1:0),match=target[idx],line=fold(lines[ln].text);
var offsetA=(reverse?line.indexOf(match)+match.length:line.lastIndexOf(match));
if(reverse?offsetA>=pos.ch||offsetA!=match.length
:offsetA<=pos.ch||offsetA!=line.length-match.length)
return;
for(;;){
if(reverse?!ln:ln==lines.length-1)return;
line=fold(lines[ln+=reverse?-1:1].text);
match=target[reverse?--idx:++idx];
if(idx>0&&idx<target.length-1){
if(line!=match)return;
else continue;
}
var offsetB=(reverse?line.lastIndexOf(match):line.indexOf(match)+match.length);
if(reverse?offsetB!=line.length-match.length:offsetB!=match.length)
return;
var start={line:pos.line,ch:offsetA},end={line:ln,ch:offsetB};
return{from:reverse?end:start,to:reverse?start:end};
}
};
}
}
SearchCursor.prototype={
findNext:function(){return this.find(false);},
findPrevious:function(){return this.find(true);},
find:function(reverse){
var self=this,pos=clipPos(reverse?this.pos.from:this.pos.to);
function savePosAndFail(line){
var pos={line:line,ch:0};
self.pos={from:pos,to:pos};
self.atOccurrence=false;
return false;
}
for(;;){
if(this.pos=this.matches(reverse,pos)){
this.atOccurrence=true;
return this.pos.match||true;
}
if(reverse){
if(!pos.line)return savePosAndFail(0);
pos={line:pos.line-1,ch:lines[pos.line-1].text.length};
}
else{
if(pos.line==lines.length-1)return savePosAndFail(lines.length);
pos={line:pos.line+1,ch:0};
}
}
},
from:function(){if(this.atOccurrence)return copyPos(this.pos.from);},
to:function(){if(this.atOccurrence)return copyPos(this.pos.to);},
replace:function(newText){
var self=this;
if(this.atOccurrence)
operation(function(){
self.pos.to=replaceRange(newText,self.pos.from,self.pos.to);
})();
}
};
for(var ext in extensions)
if(extensions.propertyIsEnumerable(ext)&&
!instance.propertyIsEnumerable(ext))
instance[ext]=extensions[ext];
return instance;
}
CodeMirror.defaults={
value:"",
mode:null,
theme:"default",
indentUnit:2,
indentWithTabs:false,
tabMode:"classic",
enterMode:"indent",
electricChars:true,
onKeyEvent:null,
lineNumbers:false,
gutter:false,
firstLineNumber:1,
readOnly:false,
onChange:null,
onCursorActivity:null,
onGutterClick:null,
onHighlightComplete:null,
onFocus:null,onBlur:null,onScroll:null,
matchBrackets:false,
workTime:100,
workDelay:200,
undoDepth:40,
tabindex:null,
document:window.document
};
var modes={},mimeModes={};
CodeMirror.defineMode=function(name,mode){
if(!CodeMirror.defaults.mode&&name!="null")CodeMirror.defaults.mode=name;
modes[name]=mode;
};
CodeMirror.defineMIME=function(mime,spec){
mimeModes[mime]=spec;
};
CodeMirror.getMode=function(options,spec){
if(typeof spec=="string"&&mimeModes.hasOwnProperty(spec))
spec=mimeModes[spec];
if(typeof spec=="string")
var mname=spec,config={};
else if(spec!=null)
var mname=spec.name,config=spec;
var mfactory=modes[mname];
if(!mfactory){
if(window.console)console.warn("No mode "+mname+" found, falling back to plain text.");
return CodeMirror.getMode(options,"text/plain");
}
return mfactory(options,config||{});
};
CodeMirror.listModes=function(){
var list=[];
for(var m in modes)
if(modes.propertyIsEnumerable(m))list.push(m);
return list;
};
CodeMirror.listMIMEs=function(){
var list=[];
for(var m in mimeModes)
if(mimeModes.propertyIsEnumerable(m))list.push(m);
return list;
};
var extensions={};
CodeMirror.defineExtension=function(name,func){
extensions[name]=func;
};
CodeMirror.fromTextArea=function(textarea,options){
if(!options)options={};
options.value=textarea.value;
if(!options.tabindex&&textarea.tabindex)
options.tabindex=textarea.tabindex;
function save(){textarea.value=instance.getValue();}
if(textarea.form){
var rmSubmit=connect(textarea.form,"submit",save,true);
if(typeof textarea.form.submit=="function"){
var realSubmit=textarea.form.submit;
function wrappedSubmit(){
save();
textarea.form.submit=realSubmit;
textarea.form.submit();
textarea.form.submit=wrappedSubmit;
}
textarea.form.submit=wrappedSubmit;
}
}
textarea.style.display="none";
var instance=CodeMirror(function(node){
textarea.parentNode.insertBefore(node,textarea.nextSibling);
},options);
instance.save=save;
instance.toTextArea=function(){
save();
textarea.parentNode.removeChild(instance.getWrapperElement());
textarea.style.display="";
if(textarea.form){
rmSubmit();
if(typeof textarea.form.submit=="function")
textarea.form.submit=realSubmit;
}
};
return instance;
};
function copyState(mode,state){
if(state===true)return state;
if(mode.copyState)return mode.copyState(state);
var nstate={};
for(var n in state){
var val=state[n];
if(val instanceof Array)val=val.concat([]);
nstate[n]=val;
}
return nstate;
}
CodeMirror.startState=startState;
function startState(mode,a1,a2){
return mode.startState?mode.startState(a1,a2):true;
}
CodeMirror.copyState=copyState;
function StringStream(string){
this.pos=this.start=0;
this.string=string;
}
StringStream.prototype={
eol:function(){return this.pos>=this.string.length;},
sol:function(){return this.pos==0;},
peek:function(){return this.string.charAt(this.pos);},
next:function(){
if(this.pos<this.string.length)
return this.string.charAt(this.pos++);
},
eat:function(match){
var ch=this.string.charAt(this.pos);
if(typeof match=="string")var ok=ch==match;
else var ok=ch&&(match.test?match.test(ch):match(ch));
if(ok){++this.pos;return ch;}
},
eatWhile:function(match){
var start=this.start;
while(this.eat(match)){}
return this.pos>start;
},
eatSpace:function(){
var start=this.pos;
while(/[\s\u00a0]/.test(this.string.charAt(this.pos)))++this.pos;
return this.pos>start;
},
skipToEnd:function(){this.pos=this.string.length;},
skipTo:function(ch){
var found=this.string.indexOf(ch,this.pos);
if(found>-1){this.pos=found;return true;}
},
backUp:function(n){this.pos-=n;},
column:function(){return countColumn(this.string,this.start);},
indentation:function(){return countColumn(this.string);},
match:function(pattern,consume,caseInsensitive){
if(typeof pattern=="string"){
function cased(str){return caseInsensitive?str.toLowerCase():str;}
if(cased(this.string).indexOf(cased(pattern),this.pos)==this.pos){
if(consume!==false)this.pos+=pattern.length;
return true;
}
}
else{
var match=this.string.slice(this.pos).match(pattern);
if(match&&consume!==false)this.pos+=match[0].length;
return match;
}
},
current:function(){return this.string.slice(this.start,this.pos);}
};
CodeMirror.StringStream=StringStream;
function Line(text,styles){
this.styles=styles||[text,null];
this.stateAfter=null;
this.text=text;
this.marked=this.gutterMarker=this.className=null;
}
Line.prototype={
replace:function(from,to,text){
var st=[],mk=this.marked;
copyStyles(0,from,this.styles,st);
if(text)st.push(text,null);
copyStyles(to,this.text.length,this.styles,st);
this.styles=st;
this.text=this.text.slice(0,from)+text+this.text.slice(to);
this.stateAfter=null;
if(mk){
var diff=text.length-(to-from),end=this.text.length;
function fix(n){return n<=Math.min(to,to+diff)?n:n+diff;}
for(var i=0;i<mk.length;++i){
var mark=mk[i],del=false;
if(mark.from>=end)del=true;
else{mark.from=fix(mark.from);if(mark.to!=null)mark.to=fix(mark.to);}
if(del||mark.from>=mark.to){mk.splice(i,1);i--;}
}
}
},
split:function(pos,textBefore){
var st=[textBefore,null];
copyStyles(pos,this.text.length,this.styles,st);
return new Line(textBefore+this.text.slice(pos),st);
},
addMark:function(from,to,style){
var mk=this.marked,mark={from:from,to:to,style:style};
if(this.marked==null)this.marked=[];
this.marked.push(mark);
this.marked.sort(function(a,b){return a.from-b.from;});
return mark;
},
removeMark:function(mark){
var mk=this.marked;
if(!mk)return;
for(var i=0;i<mk.length;++i)
if(mk[i]==mark){mk.splice(i,1);break;}
},
highlight:function(mode,state){
var stream=new StringStream(this.text),st=this.styles,pos=0;
var changed=false,curWord=st[0],prevWord;
if(this.text==""&&mode.blankLine)mode.blankLine(state);
while(!stream.eol()){
var style=mode.token(stream,state);
var substr=this.text.slice(stream.start,stream.pos);
stream.start=stream.pos;
if(pos&&st[pos-1]==style)
st[pos-2]+=substr;
else if(substr){
if(!changed&&(st[pos+1]!=style||(pos&&st[pos-2]!=prevWord)))changed=true;
st[pos++]=substr;st[pos++]=style;
prevWord=curWord;curWord=st[pos];
}
if(stream.pos>5000){
st[pos++]=this.text.slice(stream.pos);st[pos++]=null;
break;
}
}
if(st.length!=pos){st.length=pos;changed=true;}
if(pos&&st[pos-2]!=prevWord)changed=true;
return changed||(st.length<5&&this.text.length<10);
},
getTokenAt:function(mode,state,ch){
var txt=this.text,stream=new StringStream(txt);
while(stream.pos<ch&&!stream.eol()){
stream.start=stream.pos;
var style=mode.token(stream,state);
}
return{start:stream.start,
end:stream.pos,
string:stream.current(),
className:style||null,
state:state};
},
indentation:function(){return countColumn(this.text);},
getHTML:function(sfrom,sto,includePre,endAt){
var html=[];
if(includePre)
html.push(this.className?'<pre class="'+this.className+'">':"<pre>");
function span(text,style){
if(!text)return;
if(style)html.push('<span class="cm-',style,'">',htmlEscape(text),"</span>");
else html.push(htmlEscape(text));
}
var st=this.styles,allText=this.text,marked=this.marked;
if(sfrom==sto)sfrom=null;
var len=allText.length;
if(endAt!=null)len=Math.min(endAt,len);
if(!allText&&endAt==null)
span(" ",sfrom!=null&&sto==null?"CodeMirror-selected":null);
else if(!marked&&sfrom==null)
for(var i=0,ch=0;ch<len;i+=2){
var str=st[i],l=str.length;
if(ch+l>len)str=str.slice(0,len-ch);
ch+=l;
span(str,st[i+1]);
}
else{
var pos=0,i=0,text="",style,sg=0;
var markpos=-1,mark=null;
function nextMark(){
if(marked){
markpos+=1;
mark=(markpos<marked.length)?marked[markpos]:null;
}
}
nextMark();
while(pos<len){
var upto=len;
var extraStyle="";
if(sfrom!=null){
if(sfrom>pos)upto=sfrom;
else if(sto==null||sto>pos){
extraStyle=" CodeMirror-selected";
if(sto!=null)upto=Math.min(upto,sto);
}
}
while(mark&&mark.to!=null&&mark.to<=pos)nextMark();
if(mark){
if(mark.from>pos)upto=Math.min(upto,mark.from);
else{
extraStyle+=" "+mark.style;
if(mark.to!=null)upto=Math.min(upto,mark.to);
}
}
for(;;){
var end=pos+text.length;
var apliedStyle=style;
if(extraStyle)apliedStyle=style?style+extraStyle:extraStyle;
span(end>upto?text.slice(0,upto-pos):text,apliedStyle);
if(end>=upto){text=text.slice(upto-pos);pos=upto;break;}
pos=end;
text=st[i++];style=st[i++];
}
}
if(sfrom!=null&&sto==null)span(" ","CodeMirror-selected");
}
if(includePre)html.push("</pre>");
return html.join("");
}
};
function copyStyles(from,to,source,dest){
for(var i=0,pos=0,state=0;pos<to;i+=2){
var part=source[i],end=pos+part.length;
if(state==0){
if(end>from)dest.push(part.slice(from-pos,Math.min(part.length,to-pos)),source[i+1]);
if(end>=from)state=1;
}
else if(state==1){
if(end>to)dest.push(part.slice(0,to-pos),source[i+1]);
else dest.push(part,source[i+1]);
}
pos=end;
}
}
function History(){
this.time=0;
this.done=[];this.undone=[];
}
History.prototype={
addChange:function(start,added,old){
this.undone.length=0;
var time=+new Date,last=this.done[this.done.length-1];
if(time-this.time>400||!last||
last.start>start+added||last.start+last.added<start-last.added+last.old.length)
this.done.push({start:start,added:added,old:old});
else{
var oldoff=0;
if(start<last.start){
for(var i=last.start-start-1;i>=0;--i)
last.old.unshift(old[i]);
last.added+=last.start-start;
last.start=start;
}
else if(last.start<start){
oldoff=start-last.start;
added+=oldoff;
}
for(var i=last.added-oldoff,e=old.length;i<e;++i)
last.old.push(old[i]);
if(last.added<added)last.added=added;
}
this.time=time;
}
};
function stopEvent(){
if(this.preventDefault){this.preventDefault();this.stopPropagation();}
else{this.returnValue=false;this.cancelBubble=true;}
}
function addStop(event){
if(!event.stop)event.stop=stopEvent;
return event;
}
function Event(orig){this.e=orig;}
Event.prototype={
stop:function(){stopEvent.call(this.e);},
target:function(){return this.e.target||this.e.srcElement;},
button:function(){
if(this.e.which)return this.e.which;
else if(this.e.button&1)return 1;
else if(this.e.button&2)return 3;
else if(this.e.button&4)return 2;
},
pageX:function(){
if(this.e.pageX!=null)return this.e.pageX;
var doc=this.target().ownerDocument;
return this.e.clientX+doc.body.scrollLeft+doc.documentElement.scrollLeft;
},
pageY:function(){
if(this.e.pageY!=null)return this.e.pageY;
var doc=this.target().ownerDocument;
return this.e.clientY+doc.body.scrollTop+doc.documentElement.scrollTop;
}
};
function connect(node,type,handler,disconnect){
function wrapHandler(event){handler(new Event(event||window.event));}
if(typeof node.addEventListener=="function"){
node.addEventListener(type,wrapHandler,false);
if(disconnect)return function(){node.removeEventListener(type,wrapHandler,false);};
}
else{
node.attachEvent("on"+type,wrapHandler);
if(disconnect)return function(){node.detachEvent("on"+type,wrapHandler);};
}
}
function Delayed(){this.id=null;}
Delayed.prototype={set:function(ms,f){clearTimeout(this.id);this.id=setTimeout(f,ms);}};
var badInnerHTML=(function(){
var pre=document.createElement("pre");
pre.innerHTML=" ";return!pre.innerHTML;
})();
var gecko=/gecko\/\d{7}/i.test(navigator.userAgent);
var ie=/MSIE \d/.test(navigator.userAgent);
var safari=/Apple Computer/.test(navigator.vendor);
var lineSep="\n";
(function(){
var te=document.createElement("textarea");
te.value="foo\nbar";
if(te.value.indexOf("\r")>-1)lineSep="\r\n";
}());
var tabSize=8;
var mac=/Mac/.test(navigator.platform);
var movementKeys={};
for(var i=35;i<=40;++i)
movementKeys[i]=movementKeys["c"+i]=true;
function countColumn(string,end){
if(end==null){
end=string.search(/[^\s\u00a0]/);
if(end==-1)end=string.length;
}
for(var i=0,n=0;i<end;++i){
if(string.charAt(i)=="\t")n+=tabSize-(n%tabSize);
else++n;
}
return n;
}
function computedStyle(elt){
if(elt.currentStyle)return elt.currentStyle;
return window.getComputedStyle(elt,null);
}
function eltOffset(node,screen){
var doc=node.ownerDocument.body;
var x=0,y=0,skipDoc=false;
for(var n=node;n;n=n.offsetParent){
x+=n.offsetLeft;y+=n.offsetTop;
if(screen&&computedStyle(n).position=="fixed")
skipDoc=true;
}
var e=screen&&!skipDoc?null:doc;
for(var n=node.parentNode;n!=e;n=n.parentNode)
if(n.scrollLeft!=null){x-=n.scrollLeft;y-=n.scrollTop;}
return{left:x,top:y};
}
function eltText(node){
return node.textContent||node.innerText||node.nodeValue||"";
}
function posEq(a,b){return a.line==b.line&&a.ch==b.ch;}
function posLess(a,b){return a.line<b.line||(a.line==b.line&&a.ch<b.ch);}
function copyPos(x){return{line:x.line,ch:x.ch};}
function htmlEscape(str){
return str.replace(/[<>&]/g,function(str){
return str=="&"?"&amp;":str=="<"?"&lt;":"&gt;";
});
}
CodeMirror.htmlEscape=htmlEscape;
function editEnd(from,to){
if(!to)return from?from.length:0;
if(!from)return to.length;
for(var i=from.length,j=to.length;i>=0&&j>=0;--i,--j)
if(from.charAt(i)!=to.charAt(j))break;
return j+1;
}
function indexOf(collection,elt){
if(collection.indexOf)return collection.indexOf(elt);
for(var i=0,e=collection.length;i<e;++i)
if(collection[i]==elt)return i;
return-1;
}
var splitLines,selRange,setSelRange;
if("\n\nb".split(/\n/).length!=3)
splitLines=function(string){
var pos=0,nl,result=[];
while((nl=string.indexOf("\n",pos))>-1){
result.push(string.slice(pos,string.charAt(nl-1)=="\r"?nl-1:nl));
pos=nl+1;
}
result.push(string.slice(pos));
return result;
};
else
splitLines=function(string){return string.split(/\r?\n/);};
CodeMirror.splitLines=splitLines;
if(window.getSelection){
selRange=function(te){
try{return{start:te.selectionStart,end:te.selectionEnd};}
catch(e){return null;}
};
if(safari)
setSelRange=function(te,start,end){
if(start==end)
te.setSelectionRange(start,end);
else{
te.setSelectionRange(start,end-1);
window.getSelection().modify("extend","forward","character");
}
};
else
setSelRange=function(te,start,end){
try{te.setSelectionRange(start,end);}
catch(e){}
};
}
else{
selRange=function(te){
try{var range=te.ownerDocument.selection.createRange();}
catch(e){return null;}
if(!range||range.parentElement()!=te)return null;
var val=te.value,len=val.length,localRange=te.createTextRange();
localRange.moveToBookmark(range.getBookmark());
var endRange=te.createTextRange();
endRange.collapse(false);
if(localRange.compareEndPoints("StartToEnd",endRange)>-1)
return{start:len,end:len};
var start=-localRange.moveStart("character",-len);
for(var i=val.indexOf("\r");i>-1&&i<start;i=val.indexOf("\r",i+1),start++){}
if(localRange.compareEndPoints("EndToEnd",endRange)>-1)
return{start:start,end:len};
var end=-localRange.moveEnd("character",-len);
for(var i=val.indexOf("\r");i>-1&&i<end;i=val.indexOf("\r",i+1),end++){}
return{start:start,end:end};
};
setSelRange=function(te,start,end){
var range=te.createTextRange();
range.collapse(true);
var endrange=range.duplicate();
var newlines=0,txt=te.value;
for(var pos=txt.indexOf("\n");pos>-1&&pos<start;pos=txt.indexOf("\n",pos+1))
++newlines;
range.move("character",start-newlines);
for(;pos>-1&&pos<end;pos=txt.indexOf("\n",pos+1))
++newlines;
endrange.move("character",end-newlines);
range.setEndPoint("EndToEnd",endrange);
range.select();
};
}
CodeMirror.defineMode("null",function(){
return{token:function(stream){stream.skipToEnd();}};
});
CodeMirror.defineMIME("text/plain","null");
return CodeMirror;
})();


/* ../plugins/auto/skeleditor/v2.7.11/codemirror/mode/css/css.js */
CodeMirror.defineMode("css",function(config){
var indentUnit=config.indentUnit,type;
function ret(style,tp){type=tp;return style;}
function tokenBase(stream,state){
var ch=stream.next();
if(ch=="@"){stream.eatWhile(/\w/);return ret("meta",stream.current());}
else if(ch=="/"&&stream.eat("*")){
state.tokenize=tokenCComment;
return tokenCComment(stream,state);
}
else if(ch=="<"&&stream.eat("!")){
state.tokenize=tokenSGMLComment;
return tokenSGMLComment(stream,state);
}
else if(ch=="=")ret(null,"compare");
else if((ch=="~"||ch=="|")&&stream.eat("="))return ret(null,"compare");
else if(ch=="\""||ch=="'"){
state.tokenize=tokenString(ch);
return state.tokenize(stream,state);
}
else if(ch=="#"){
stream.eatWhile(/\w/);
return ret("atom","hash");
}
else if(ch=="!"){
stream.match(/^\s*\w*/);
return ret("keyword","important");
}
else if(/\d/.test(ch)){
stream.eatWhile(/[\w.%]/);
return ret("number","unit");
}
else if(/[,.+>*\/]/.test(ch)){
return ret(null,"select-op");
}
else if(/[;{}:\[\]]/.test(ch)){
return ret(null,ch);
}
else{
stream.eatWhile(/[\w\\\-_]/);
return ret("variable","variable");
}
}
function tokenCComment(stream,state){
var maybeEnd=false,ch;
while((ch=stream.next())!=null){
if(maybeEnd&&ch=="/"){
state.tokenize=tokenBase;
break;
}
maybeEnd=(ch=="*");
}
return ret("comment","comment");
}
function tokenSGMLComment(stream,state){
var dashes=0,ch;
while((ch=stream.next())!=null){
if(dashes>=2&&ch==">"){
state.tokenize=tokenBase;
break;
}
dashes=(ch=="-")?dashes+1:0;
}
return ret("comment","comment");
}
function tokenString(quote){
return function(stream,state){
var escaped=false,ch;
while((ch=stream.next())!=null){
if(ch==quote&&!escaped)
break;
escaped=!escaped&&ch=="\\";
}
if(!escaped)state.tokenize=tokenBase;
return ret("string","string");
};
}
return{
startState:function(base){
return{tokenize:tokenBase,
baseIndent:base||0,
stack:[]};
},
token:function(stream,state){
if(stream.eatSpace())return null;
var style=state.tokenize(stream,state);
var context=state.stack[state.stack.length-1];
if(type=="hash"&&context=="rule")style="atom";
else if(style=="variable"){
if(context=="rule")style="number";
else if(!context||context=="@media{")style="tag";
}
if(context=="rule"&&/^[\{\};]$/.test(type))
state.stack.pop();
if(type=="{"){
if(context=="@media")state.stack[state.stack.length-1]="@media{";
else state.stack.push("{");
}
else if(type=="}")state.stack.pop();
else if(type=="@media")state.stack.push("@media");
else if(context=="{"&&type!="comment")state.stack.push("rule");
return style;
},
indent:function(state,textAfter){
var n=state.stack.length;
if(/^\}/.test(textAfter))
n-=state.stack[state.stack.length-1]=="rule"?2:1;
return state.baseIndent+n*indentUnit;
},
electricChars:"}"
};
});
CodeMirror.defineMIME("text/css","css");


/* ../plugins/auto/skeleditor/v2.7.11/javascript/codemirror_init.js */
var cm_options={
lineNumbers:true,
matchBrackets:true,
indentUnit:6,
indentWithTabs:true,
enterMode:"keep",
tabMode:"shift"
};
if(cm_mode.length)
cm_options.mode=cm_mode;
var editor;
var lastPos=null,lastQuery=null,marked=[];
function editor_init(){
editor=CodeMirror.fromTextArea(document.getElementById('code'),cm_options);
}
function unmark(){
for(var i=0;i<marked.length;++i)marked[i]();
marked.length=0;
}
function search(){
unmark();
var text=document.getElementById("query").value;
if(!text)return;
for(var cursor=editor.getSearchCursor(text);cursor.findNext();)
marked.push(editor.markText(cursor.from(),cursor.to(),"searched"));
if(lastQuery!=text)lastPos=null;
var cursor=editor.getSearchCursor(text,lastPos||editor.getCursor());
if(!cursor.findNext()){
cursor=editor.getSearchCursor(text);
if(!cursor.findNext())return;
}
editor.setSelection(cursor.from(),cursor.to());
lastQuery=text;lastPos=cursor.to();
}
function replace(){
unmark();
var text=document.getElementById("query").value,
replace=document.getElementById("replace").value;
if(!text)return;
for(var cursor=editor.getSearchCursor(text);cursor.findNext();)
editor.replaceRange(replace,cursor.from(),cursor.to());
}
setTimeout(editor_init,300);


