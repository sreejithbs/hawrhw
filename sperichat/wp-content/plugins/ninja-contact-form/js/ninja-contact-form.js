var NKS_DEBUG = true;

;(function (window) {
	if (window.ncf_transitionEnd) return;

	var transitions = {
			'transition': 'transitionend',
			'WebkitTransition': 'webkitTransitionEnd',
			'MozTransition': 'transitionend',
			'OTransition': 'otransitionend'
		},
		elem = document.createElement('div');

	for(var t in transitions){
		if(typeof elem.style[t] !== 'undefined'){
			window.ncf_transitionEnd = transitions[t];
			break;
		}
	}
	if (!window.ncf_transitionEnd) window.ncf_transitionEnd = false;
})(window);

jQuery(document).one('ncf_ready', function($){

	if (/MSIE 8/.test(navigator.userAgent)) return;

	var $ = jQuery;

	eval(function(p, a, c, k, e, r) {
		e = function(c) {
			return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
		};
		if (!''.replace(/^/, String)) {
			while (c--) r[e(c)] = k[c] || e(c);
			k = [
				function(e) {
					return r[e]
				}
			];
			e = function() {
				return '\\w+'
			};
			c = 1
		};
		while (c--)
			if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
		return p
	}('9 17={3i:\'0.1.3\',16:1e-6};l v(){}v.23={e:l(i){8(i<1||i>7.4.q)?w:7.4[i-1]},2R:l(){8 7.4.q},1u:l(){8 F.1x(7.2u(7))},24:l(a){9 n=7.4.q;9 V=a.4||a;o(n!=V.q){8 1L}J{o(F.13(7.4[n-1]-V[n-1])>17.16){8 1L}}H(--n);8 2x},1q:l(){8 v.u(7.4)},1b:l(a){9 b=[];7.28(l(x,i){b.19(a(x,i))});8 v.u(b)},28:l(a){9 n=7.4.q,k=n,i;J{i=k-n;a(7.4[i],i+1)}H(--n)},2q:l(){9 r=7.1u();o(r===0){8 7.1q()}8 7.1b(l(x){8 x/r})},1C:l(a){9 V=a.4||a;9 n=7.4.q,k=n,i;o(n!=V.q){8 w}9 b=0,1D=0,1F=0;7.28(l(x,i){b+=x*V[i-1];1D+=x*x;1F+=V[i-1]*V[i-1]});1D=F.1x(1D);1F=F.1x(1F);o(1D*1F===0){8 w}9 c=b/(1D*1F);o(c<-1){c=-1}o(c>1){c=1}8 F.37(c)},1m:l(a){9 b=7.1C(a);8(b===w)?w:(b<=17.16)},34:l(a){9 b=7.1C(a);8(b===w)?w:(F.13(b-F.1A)<=17.16)},2k:l(a){9 b=7.2u(a);8(b===w)?w:(F.13(b)<=17.16)},2j:l(a){9 V=a.4||a;o(7.4.q!=V.q){8 w}8 7.1b(l(x,i){8 x+V[i-1]})},2C:l(a){9 V=a.4||a;o(7.4.q!=V.q){8 w}8 7.1b(l(x,i){8 x-V[i-1]})},22:l(k){8 7.1b(l(x){8 x*k})},x:l(k){8 7.22(k)},2u:l(a){9 V=a.4||a;9 i,2g=0,n=7.4.q;o(n!=V.q){8 w}J{2g+=7.4[n-1]*V[n-1]}H(--n);8 2g},2f:l(a){9 B=a.4||a;o(7.4.q!=3||B.q!=3){8 w}9 A=7.4;8 v.u([(A[1]*B[2])-(A[2]*B[1]),(A[2]*B[0])-(A[0]*B[2]),(A[0]*B[1])-(A[1]*B[0])])},2A:l(){9 m=0,n=7.4.q,k=n,i;J{i=k-n;o(F.13(7.4[i])>F.13(m)){m=7.4[i]}}H(--n);8 m},2Z:l(x){9 a=w,n=7.4.q,k=n,i;J{i=k-n;o(a===w&&7.4[i]==x){a=i+1}}H(--n);8 a},3g:l(){8 S.2X(7.4)},2d:l(){8 7.1b(l(x){8 F.2d(x)})},2V:l(x){8 7.1b(l(y){8(F.13(y-x)<=17.16)?x:y})},1o:l(a){o(a.K){8 a.1o(7)}9 V=a.4||a;o(V.q!=7.4.q){8 w}9 b=0,2b;7.28(l(x,i){2b=x-V[i-1];b+=2b*2b});8 F.1x(b)},3a:l(a){8 a.1h(7)},2T:l(a){8 a.1h(7)},1V:l(t,a){9 V,R,x,y,z;2S(7.4.q){27 2:V=a.4||a;o(V.q!=2){8 w}R=S.1R(t).4;x=7.4[0]-V[0];y=7.4[1]-V[1];8 v.u([V[0]+R[0][0]*x+R[0][1]*y,V[1]+R[1][0]*x+R[1][1]*y]);1I;27 3:o(!a.U){8 w}9 C=a.1r(7).4;R=S.1R(t,a.U).4;x=7.4[0]-C[0];y=7.4[1]-C[1];z=7.4[2]-C[2];8 v.u([C[0]+R[0][0]*x+R[0][1]*y+R[0][2]*z,C[1]+R[1][0]*x+R[1][1]*y+R[1][2]*z,C[2]+R[2][0]*x+R[2][1]*y+R[2][2]*z]);1I;2P:8 w}},1t:l(a){o(a.K){9 P=7.4.2O();9 C=a.1r(P).4;8 v.u([C[0]+(C[0]-P[0]),C[1]+(C[1]-P[1]),C[2]+(C[2]-(P[2]||0))])}1d{9 Q=a.4||a;o(7.4.q!=Q.q){8 w}8 7.1b(l(x,i){8 Q[i-1]+(Q[i-1]-x)})}},1N:l(){9 V=7.1q();2S(V.4.q){27 3:1I;27 2:V.4.19(0);1I;2P:8 w}8 V},2n:l(){8\'[\'+7.4.2K(\', \')+\']\'},26:l(a){7.4=(a.4||a).2O();8 7}};v.u=l(a){9 V=25 v();8 V.26(a)};v.i=v.u([1,0,0]);v.j=v.u([0,1,0]);v.k=v.u([0,0,1]);v.2J=l(n){9 a=[];J{a.19(F.2F())}H(--n);8 v.u(a)};v.1j=l(n){9 a=[];J{a.19(0)}H(--n);8 v.u(a)};l S(){}S.23={e:l(i,j){o(i<1||i>7.4.q||j<1||j>7.4[0].q){8 w}8 7.4[i-1][j-1]},33:l(i){o(i>7.4.q){8 w}8 v.u(7.4[i-1])},2E:l(j){o(j>7.4[0].q){8 w}9 a=[],n=7.4.q,k=n,i;J{i=k-n;a.19(7.4[i][j-1])}H(--n);8 v.u(a)},2R:l(){8{2D:7.4.q,1p:7.4[0].q}},2D:l(){8 7.4.q},1p:l(){8 7.4[0].q},24:l(a){9 M=a.4||a;o(1g(M[0][0])==\'1f\'){M=S.u(M).4}o(7.4.q!=M.q||7.4[0].q!=M[0].q){8 1L}9 b=7.4.q,15=b,i,G,10=7.4[0].q,j;J{i=15-b;G=10;J{j=10-G;o(F.13(7.4[i][j]-M[i][j])>17.16){8 1L}}H(--G)}H(--b);8 2x},1q:l(){8 S.u(7.4)},1b:l(a){9 b=[],12=7.4.q,15=12,i,G,10=7.4[0].q,j;J{i=15-12;G=10;b[i]=[];J{j=10-G;b[i][j]=a(7.4[i][j],i+1,j+1)}H(--G)}H(--12);8 S.u(b)},2i:l(a){9 M=a.4||a;o(1g(M[0][0])==\'1f\'){M=S.u(M).4}8(7.4.q==M.q&&7.4[0].q==M[0].q)},2j:l(a){9 M=a.4||a;o(1g(M[0][0])==\'1f\'){M=S.u(M).4}o(!7.2i(M)){8 w}8 7.1b(l(x,i,j){8 x+M[i-1][j-1]})},2C:l(a){9 M=a.4||a;o(1g(M[0][0])==\'1f\'){M=S.u(M).4}o(!7.2i(M)){8 w}8 7.1b(l(x,i,j){8 x-M[i-1][j-1]})},2B:l(a){9 M=a.4||a;o(1g(M[0][0])==\'1f\'){M=S.u(M).4}8(7.4[0].q==M.q)},22:l(a){o(!a.4){8 7.1b(l(x){8 x*a})}9 b=a.1u?2x:1L;9 M=a.4||a;o(1g(M[0][0])==\'1f\'){M=S.u(M).4}o(!7.2B(M)){8 w}9 d=7.4.q,15=d,i,G,10=M[0].q,j;9 e=7.4[0].q,4=[],21,20,c;J{i=15-d;4[i]=[];G=10;J{j=10-G;21=0;20=e;J{c=e-20;21+=7.4[i][c]*M[c][j]}H(--20);4[i][j]=21}H(--G)}H(--d);9 M=S.u(4);8 b?M.2E(1):M},x:l(a){8 7.22(a)},32:l(a,b,c,d){9 e=[],12=c,i,G,j;9 f=7.4.q,1p=7.4[0].q;J{i=c-12;e[i]=[];G=d;J{j=d-G;e[i][j]=7.4[(a+i-1)%f][(b+j-1)%1p]}H(--G)}H(--12);8 S.u(e)},31:l(){9 a=7.4.q,1p=7.4[0].q;9 b=[],12=1p,i,G,j;J{i=1p-12;b[i]=[];G=a;J{j=a-G;b[i][j]=7.4[j][i]}H(--G)}H(--12);8 S.u(b)},1y:l(){8(7.4.q==7.4[0].q)},2A:l(){9 m=0,12=7.4.q,15=12,i,G,10=7.4[0].q,j;J{i=15-12;G=10;J{j=10-G;o(F.13(7.4[i][j])>F.13(m)){m=7.4[i][j]}}H(--G)}H(--12);8 m},2Z:l(x){9 a=w,12=7.4.q,15=12,i,G,10=7.4[0].q,j;J{i=15-12;G=10;J{j=10-G;o(7.4[i][j]==x){8{i:i+1,j:j+1}}}H(--G)}H(--12);8 w},30:l(){o(!7.1y){8 w}9 a=[],n=7.4.q,k=n,i;J{i=k-n;a.19(7.4[i][i])}H(--n);8 v.u(a)},1K:l(){9 M=7.1q(),1c;9 n=7.4.q,k=n,i,1s,1n=7.4[0].q,p;J{i=k-n;o(M.4[i][i]==0){2e(j=i+1;j<k;j++){o(M.4[j][i]!=0){1c=[];1s=1n;J{p=1n-1s;1c.19(M.4[i][p]+M.4[j][p])}H(--1s);M.4[i]=1c;1I}}}o(M.4[i][i]!=0){2e(j=i+1;j<k;j++){9 a=M.4[j][i]/M.4[i][i];1c=[];1s=1n;J{p=1n-1s;1c.19(p<=i?0:M.4[j][p]-M.4[i][p]*a)}H(--1s);M.4[j]=1c}}}H(--n);8 M},3h:l(){8 7.1K()},2z:l(){o(!7.1y()){8 w}9 M=7.1K();9 a=M.4[0][0],n=M.4.q-1,k=n,i;J{i=k-n+1;a=a*M.4[i][i]}H(--n);8 a},3f:l(){8 7.2z()},2y:l(){8(7.1y()&&7.2z()===0)},2Y:l(){o(!7.1y()){8 w}9 a=7.4[0][0],n=7.4.q-1,k=n,i;J{i=k-n+1;a+=7.4[i][i]}H(--n);8 a},3e:l(){8 7.2Y()},1Y:l(){9 M=7.1K(),1Y=0;9 a=7.4.q,15=a,i,G,10=7.4[0].q,j;J{i=15-a;G=10;J{j=10-G;o(F.13(M.4[i][j])>17.16){1Y++;1I}}H(--G)}H(--a);8 1Y},3d:l(){8 7.1Y()},2W:l(a){9 M=a.4||a;o(1g(M[0][0])==\'1f\'){M=S.u(M).4}9 T=7.1q(),1p=T.4[0].q;9 b=T.4.q,15=b,i,G,10=M[0].q,j;o(b!=M.q){8 w}J{i=15-b;G=10;J{j=10-G;T.4[i][1p+j]=M[i][j]}H(--G)}H(--b);8 T},2w:l(){o(!7.1y()||7.2y()){8 w}9 a=7.4.q,15=a,i,j;9 M=7.2W(S.I(a)).1K();9 b,1n=M.4[0].q,p,1c,2v;9 c=[],2c;J{i=a-1;1c=[];b=1n;c[i]=[];2v=M.4[i][i];J{p=1n-b;2c=M.4[i][p]/2v;1c.19(2c);o(p>=15){c[i].19(2c)}}H(--b);M.4[i]=1c;2e(j=0;j<i;j++){1c=[];b=1n;J{p=1n-b;1c.19(M.4[j][p]-M.4[i][p]*M.4[j][i])}H(--b);M.4[j]=1c}}H(--a);8 S.u(c)},3c:l(){8 7.2w()},2d:l(){8 7.1b(l(x){8 F.2d(x)})},2V:l(x){8 7.1b(l(p){8(F.13(p-x)<=17.16)?x:p})},2n:l(){9 a=[];9 n=7.4.q,k=n,i;J{i=k-n;a.19(v.u(7.4[i]).2n())}H(--n);8 a.2K(\'\\n\')},26:l(a){9 i,4=a.4||a;o(1g(4[0][0])!=\'1f\'){9 b=4.q,15=b,G,10,j;7.4=[];J{i=15-b;G=4[i].q;10=G;7.4[i]=[];J{j=10-G;7.4[i][j]=4[i][j]}H(--G)}H(--b);8 7}9 n=4.q,k=n;7.4=[];J{i=k-n;7.4.19([4[i]])}H(--n);8 7}};S.u=l(a){9 M=25 S();8 M.26(a)};S.I=l(n){9 a=[],k=n,i,G,j;J{i=k-n;a[i]=[];G=k;J{j=k-G;a[i][j]=(i==j)?1:0}H(--G)}H(--n);8 S.u(a)};S.2X=l(a){9 n=a.q,k=n,i;9 M=S.I(n);J{i=k-n;M.4[i][i]=a[i]}H(--n);8 M};S.1R=l(b,a){o(!a){8 S.u([[F.1H(b),-F.1G(b)],[F.1G(b),F.1H(b)]])}9 d=a.1q();o(d.4.q!=3){8 w}9 e=d.1u();9 x=d.4[0]/e,y=d.4[1]/e,z=d.4[2]/e;9 s=F.1G(b),c=F.1H(b),t=1-c;8 S.u([[t*x*x+c,t*x*y-s*z,t*x*z+s*y],[t*x*y+s*z,t*y*y+c,t*y*z-s*x],[t*x*z-s*y,t*y*z+s*x,t*z*z+c]])};S.3b=l(t){9 c=F.1H(t),s=F.1G(t);8 S.u([[1,0,0],[0,c,-s],[0,s,c]])};S.39=l(t){9 c=F.1H(t),s=F.1G(t);8 S.u([[c,0,s],[0,1,0],[-s,0,c]])};S.38=l(t){9 c=F.1H(t),s=F.1G(t);8 S.u([[c,-s,0],[s,c,0],[0,0,1]])};S.2J=l(n,m){8 S.1j(n,m).1b(l(){8 F.2F()})};S.1j=l(n,m){9 a=[],12=n,i,G,j;J{i=n-12;a[i]=[];G=m;J{j=m-G;a[i][j]=0}H(--G)}H(--12);8 S.u(a)};l 14(){}14.23={24:l(a){8(7.1m(a)&&7.1h(a.K))},1q:l(){8 14.u(7.K,7.U)},2U:l(a){9 V=a.4||a;8 14.u([7.K.4[0]+V[0],7.K.4[1]+V[1],7.K.4[2]+(V[2]||0)],7.U)},1m:l(a){o(a.W){8 a.1m(7)}9 b=7.U.1C(a.U);8(F.13(b)<=17.16||F.13(b-F.1A)<=17.16)},1o:l(a){o(a.W){8 a.1o(7)}o(a.U){o(7.1m(a)){8 7.1o(a.K)}9 N=7.U.2f(a.U).2q().4;9 A=7.K.4,B=a.K.4;8 F.13((A[0]-B[0])*N[0]+(A[1]-B[1])*N[1]+(A[2]-B[2])*N[2])}1d{9 P=a.4||a;9 A=7.K.4,D=7.U.4;9 b=P[0]-A[0],2a=P[1]-A[1],29=(P[2]||0)-A[2];9 c=F.1x(b*b+2a*2a+29*29);o(c===0)8 0;9 d=(b*D[0]+2a*D[1]+29*D[2])/c;9 e=1-d*d;8 F.13(c*F.1x(e<0?0:e))}},1h:l(a){9 b=7.1o(a);8(b!==w&&b<=17.16)},2T:l(a){8 a.1h(7)},1v:l(a){o(a.W){8 a.1v(7)}8(!7.1m(a)&&7.1o(a)<=17.16)},1U:l(a){o(a.W){8 a.1U(7)}o(!7.1v(a)){8 w}9 P=7.K.4,X=7.U.4,Q=a.K.4,Y=a.U.4;9 b=X[0],1z=X[1],1B=X[2],1T=Y[0],1S=Y[1],1M=Y[2];9 c=P[0]-Q[0],2s=P[1]-Q[1],2r=P[2]-Q[2];9 d=-b*c-1z*2s-1B*2r;9 e=1T*c+1S*2s+1M*2r;9 f=b*b+1z*1z+1B*1B;9 g=1T*1T+1S*1S+1M*1M;9 h=b*1T+1z*1S+1B*1M;9 k=(d*g/f+h*e)/(g-h*h);8 v.u([P[0]+k*b,P[1]+k*1z,P[2]+k*1B])},1r:l(a){o(a.U){o(7.1v(a)){8 7.1U(a)}o(7.1m(a)){8 w}9 D=7.U.4,E=a.U.4;9 b=D[0],1l=D[1],1k=D[2],1P=E[0],1O=E[1],1Q=E[2];9 x=(1k*1P-b*1Q),y=(b*1O-1l*1P),z=(1l*1Q-1k*1O);9 N=v.u([x*1Q-y*1O,y*1P-z*1Q,z*1O-x*1P]);9 P=11.u(a.K,N);8 P.1U(7)}1d{9 P=a.4||a;o(7.1h(P)){8 v.u(P)}9 A=7.K.4,D=7.U.4;9 b=D[0],1l=D[1],1k=D[2],1w=A[0],18=A[1],1a=A[2];9 x=b*(P[1]-18)-1l*(P[0]-1w),y=1l*((P[2]||0)-1a)-1k*(P[1]-18),z=1k*(P[0]-1w)-b*((P[2]||0)-1a);9 V=v.u([1l*x-1k*z,1k*y-b*x,b*z-1l*y]);9 k=7.1o(P)/V.1u();8 v.u([P[0]+V.4[0]*k,P[1]+V.4[1]*k,(P[2]||0)+V.4[2]*k])}},1V:l(t,a){o(1g(a.U)==\'1f\'){a=14.u(a.1N(),v.k)}9 R=S.1R(t,a.U).4;9 C=a.1r(7.K).4;9 A=7.K.4,D=7.U.4;9 b=C[0],1E=C[1],1J=C[2],1w=A[0],18=A[1],1a=A[2];9 x=1w-b,y=18-1E,z=1a-1J;8 14.u([b+R[0][0]*x+R[0][1]*y+R[0][2]*z,1E+R[1][0]*x+R[1][1]*y+R[1][2]*z,1J+R[2][0]*x+R[2][1]*y+R[2][2]*z],[R[0][0]*D[0]+R[0][1]*D[1]+R[0][2]*D[2],R[1][0]*D[0]+R[1][1]*D[1]+R[1][2]*D[2],R[2][0]*D[0]+R[2][1]*D[1]+R[2][2]*D[2]])},1t:l(a){o(a.W){9 A=7.K.4,D=7.U.4;9 b=A[0],18=A[1],1a=A[2],2N=D[0],1l=D[1],1k=D[2];9 c=7.K.1t(a).4;9 d=b+2N,2h=18+1l,2o=1a+1k;9 Q=a.1r([d,2h,2o]).4;9 e=[Q[0]+(Q[0]-d)-c[0],Q[1]+(Q[1]-2h)-c[1],Q[2]+(Q[2]-2o)-c[2]];8 14.u(c,e)}1d o(a.U){8 7.1V(F.1A,a)}1d{9 P=a.4||a;8 14.u(7.K.1t([P[0],P[1],(P[2]||0)]),7.U)}},1Z:l(a,b){a=v.u(a);b=v.u(b);o(a.4.q==2){a.4.19(0)}o(b.4.q==2){b.4.19(0)}o(a.4.q>3||b.4.q>3){8 w}9 c=b.1u();o(c===0){8 w}7.K=a;7.U=v.u([b.4[0]/c,b.4[1]/c,b.4[2]/c]);8 7}};14.u=l(a,b){9 L=25 14();8 L.1Z(a,b)};14.X=14.u(v.1j(3),v.i);14.Y=14.u(v.1j(3),v.j);14.Z=14.u(v.1j(3),v.k);l 11(){}11.23={24:l(a){8(7.1h(a.K)&&7.1m(a))},1q:l(){8 11.u(7.K,7.W)},2U:l(a){9 V=a.4||a;8 11.u([7.K.4[0]+V[0],7.K.4[1]+V[1],7.K.4[2]+(V[2]||0)],7.W)},1m:l(a){9 b;o(a.W){b=7.W.1C(a.W);8(F.13(b)<=17.16||F.13(F.1A-b)<=17.16)}1d o(a.U){8 7.W.2k(a.U)}8 w},2k:l(a){9 b=7.W.1C(a.W);8(F.13(F.1A/2-b)<=17.16)},1o:l(a){o(7.1v(a)||7.1h(a)){8 0}o(a.K){9 A=7.K.4,B=a.K.4,N=7.W.4;8 F.13((A[0]-B[0])*N[0]+(A[1]-B[1])*N[1]+(A[2]-B[2])*N[2])}1d{9 P=a.4||a;9 A=7.K.4,N=7.W.4;8 F.13((A[0]-P[0])*N[0]+(A[1]-P[1])*N[1]+(A[2]-(P[2]||0))*N[2])}},1h:l(a){o(a.W){8 w}o(a.U){8(7.1h(a.K)&&7.1h(a.K.2j(a.U)))}1d{9 P=a.4||a;9 A=7.K.4,N=7.W.4;9 b=F.13(N[0]*(A[0]-P[0])+N[1]*(A[1]-P[1])+N[2]*(A[2]-(P[2]||0)));8(b<=17.16)}},1v:l(a){o(1g(a.U)==\'1f\'&&1g(a.W)==\'1f\'){8 w}8!7.1m(a)},1U:l(a){o(!7.1v(a)){8 w}o(a.U){9 A=a.K.4,D=a.U.4,P=7.K.4,N=7.W.4;9 b=(N[0]*(P[0]-A[0])+N[1]*(P[1]-A[1])+N[2]*(P[2]-A[2]))/(N[0]*D[0]+N[1]*D[1]+N[2]*D[2]);8 v.u([A[0]+D[0]*b,A[1]+D[1]*b,A[2]+D[2]*b])}1d o(a.W){9 c=7.W.2f(a.W).2q();9 N=7.W.4,A=7.K.4,O=a.W.4,B=a.K.4;9 d=S.1j(2,2),i=0;H(d.2y()){i++;d=S.u([[N[i%3],N[(i+1)%3]],[O[i%3],O[(i+1)%3]]])}9 e=d.2w().4;9 x=N[0]*A[0]+N[1]*A[1]+N[2]*A[2];9 y=O[0]*B[0]+O[1]*B[1]+O[2]*B[2];9 f=[e[0][0]*x+e[0][1]*y,e[1][0]*x+e[1][1]*y];9 g=[];2e(9 j=1;j<=3;j++){g.19((i==j)?0:f[(j+(5-i)%3)%3])}8 14.u(g,c)}},1r:l(a){9 P=a.4||a;9 A=7.K.4,N=7.W.4;9 b=(A[0]-P[0])*N[0]+(A[1]-P[1])*N[1]+(A[2]-(P[2]||0))*N[2];8 v.u([P[0]+N[0]*b,P[1]+N[1]*b,(P[2]||0)+N[2]*b])},1V:l(t,a){9 R=S.1R(t,a.U).4;9 C=a.1r(7.K).4;9 A=7.K.4,N=7.W.4;9 b=C[0],1E=C[1],1J=C[2],1w=A[0],18=A[1],1a=A[2];9 x=1w-b,y=18-1E,z=1a-1J;8 11.u([b+R[0][0]*x+R[0][1]*y+R[0][2]*z,1E+R[1][0]*x+R[1][1]*y+R[1][2]*z,1J+R[2][0]*x+R[2][1]*y+R[2][2]*z],[R[0][0]*N[0]+R[0][1]*N[1]+R[0][2]*N[2],R[1][0]*N[0]+R[1][1]*N[1]+R[1][2]*N[2],R[2][0]*N[0]+R[2][1]*N[1]+R[2][2]*N[2]])},1t:l(a){o(a.W){9 A=7.K.4,N=7.W.4;9 b=A[0],18=A[1],1a=A[2],2M=N[0],2L=N[1],2Q=N[2];9 c=7.K.1t(a).4;9 d=b+2M,2p=18+2L,2m=1a+2Q;9 Q=a.1r([d,2p,2m]).4;9 e=[Q[0]+(Q[0]-d)-c[0],Q[1]+(Q[1]-2p)-c[1],Q[2]+(Q[2]-2m)-c[2]];8 11.u(c,e)}1d o(a.U){8 7.1V(F.1A,a)}1d{9 P=a.4||a;8 11.u(7.K.1t([P[0],P[1],(P[2]||0)]),7.W)}},1Z:l(a,b,c){a=v.u(a);a=a.1N();o(a===w){8 w}b=v.u(b);b=b.1N();o(b===w){8 w}o(1g(c)==\'1f\'){c=w}1d{c=v.u(c);c=c.1N();o(c===w){8 w}}9 d=a.4[0],18=a.4[1],1a=a.4[2];9 e=b.4[0],1W=b.4[1],1X=b.4[2];9 f,1i;o(c!==w){9 g=c.4[0],2l=c.4[1],2t=c.4[2];f=v.u([(1W-18)*(2t-1a)-(1X-1a)*(2l-18),(1X-1a)*(g-d)-(e-d)*(2t-1a),(e-d)*(2l-18)-(1W-18)*(g-d)]);1i=f.1u();o(1i===0){8 w}f=v.u([f.4[0]/1i,f.4[1]/1i,f.4[2]/1i])}1d{1i=F.1x(e*e+1W*1W+1X*1X);o(1i===0){8 w}f=v.u([b.4[0]/1i,b.4[1]/1i,b.4[2]/1i])}7.K=a;7.W=f;8 7}};11.u=l(a,b,c){9 P=25 11();8 P.1Z(a,b,c)};11.2I=11.u(v.1j(3),v.k);11.2H=11.u(v.1j(3),v.i);11.2G=11.u(v.1j(3),v.j);11.36=11.2I;11.35=11.2H;11.3j=11.2G;9 $V=v.u;9 $M=S.u;9 $L=14.u;9 $P=11.u;', 62, 206, '||||elements|||this|return|var||||||||||||function|||if||length||||create|Vector|null|||||||||Math|nj|while||do|anchor||||||||Matrix||direction||normal||||kj|Plane|ni|abs|Line|ki|precision|Sylvester|A2|push|A3|map|els|else||undefined|typeof|contains|mod|Zero|D3|D2|isParallelTo|kp|distanceFrom|cols|dup|pointClosestTo|np|reflectionIn|modulus|intersects|A1|sqrt|isSquare|X2|PI|X3|angleFrom|mod1|C2|mod2|sin|cos|break|C3|toRightTriangular|false|Y3|to3D|E2|E1|E3|Rotation|Y2|Y1|intersectionWith|rotate|v12|v13|rank|setVectors|nc|sum|multiply|prototype|eql|new|setElements|case|each|PA3|PA2|part|new_element|round|for|cross|product|AD2|isSameSizeAs|add|isPerpendicularTo|v22|AN3|inspect|AD3|AN2|toUnitVector|PsubQ3|PsubQ2|v23|dot|divisor|inverse|true|isSingular|determinant|max|canMultiplyFromLeft|subtract|rows|col|random|ZX|YZ|XY|Random|join|N2|N1|D1|slice|default|N3|dimensions|switch|liesIn|translate|snapTo|augment|Diagonal|trace|indexOf|diagonal|transpose|minor|row|isAntiparallelTo|ZY|YX|acos|RotationZ|RotationY|liesOn|RotationX|inv|rk|tr|det|toDiagonalMatrix|toUpperTriangular|version|XZ'.split('|'), 0, {}))

	var _T = {
		rotate: function(deg)
		{
			var rad = parseFloat(deg) * (Math.PI/180),
				costheta = Math.cos(rad),
				sintheta = Math.sin(rad);

			var a = costheta,
				b = sintheta,
				c = -sintheta,
				d = costheta;

			return $M([
				[a, c, 0],
				[b, d, 0],
				[0, 0, 1]
			]);
		},

		skew: function(dx, dy)
		{
			var radX = parseFloat(dx) * (Math.PI/180),
				radY = parseFloat(dy) * (Math.PI/180),
				c = Math.tan(radX),
				b = Math.tan(radY);


			return $M([
				[1, c, 0],
				[b, 1, 0],
				[0, 0, 1]
			]);
		},

		translate: function(x, y)
		{
			var e = x || 0,
				f = y || 0;

			return $M([
				[1, 0, e],
				[0, 1, f],
				[0, 0, 1]
			]);
		},

		scale: function(x, y)
		{
			var a = x || 0,
				d = y || 0;

			return $M([
				[a, 0, 0],
				[0, d, 0],
				[0, 0, 1]
			]);
		},

		toString: function (m)
		{
			var s = 'matrix(',
				r, c;

			for (c=1;c<=3;c++)
			{
				for (r=1;r<=2;r++)
					s += m.e(r,c)+', ';
			}

			s = s.substr(0, s.length-2) + ')';

			return s;
		},

		fromString: function (s)
		{
			var t = /^matrix\((\S*), (\S*), (\S*), (\S*), (\S*), (\S*)\)$/g.exec(s),
				a = parseFloat(!t ? 1 : t[1]),
				b = parseFloat(!t ? 0 : t[2]),
				c = parseFloat(!t ? 0 : t[3]),
				d = parseFloat(!t ? 1 : t[4]),
				e = parseFloat(!t ? 0 : t[5]),
				f = parseFloat(!t ? 0 : t[6]);

			return $M([
				[a, c, e],
				[b, d, f],
				[0, 0, 1]
			]);
		}
	};

	// jQuery form validation light-weight plugin
	// https://github.com/Tape/jValidator
	;(function($) {

		/* Defaults
		 * ======== */

		var
			defaults = {
				api_fn: function(e) {
					if(!$(this).jvalidator().valid)
						e.preventDefault();
				},
				api_selector: "[data-validate=true]",
				error_fn: $.noop,
				field_attr: "name",
				fields: "input, textarea, select",
				regex: { email: /.+@.+/ },
				use_api: true
			},

			ips = {
				4: { split: ".", segments: 4, radix: 10, upper: 255 },
				6: { split: ":", segments: 8, radix: 16, upper: 0xFFFF }
			},

			functions = {
				required: function() {
					return this.field === true || !!this.field.length;
				},

				min: function(len) {
					return this.field.length >= +len;
				},

				max: function(len) {
					return this.field.length <= +len;
				},

				matches: function(field) {
					return this.form[field] === this.field;
				},

				less: function(num) {
					return +this.field < +num;
				},

				greater: function(num) {
					return +this.field > +num;
				},

				numeric: function() {
					return !isNaN(+this.field);
				},

				email: function() {
					return this.field.match(this.opts.regex.email);
				},

				answer: function(answer) {
					return +this.field == +answer
				},

				ip: function(verno) {
					var ver = ips[verno ? verno : "4"],
						parts = this.field.split(ver.split),
						i = 0, num;

					if(!ver || parts.length != ver.segments)
						return false;

					for(; i < ver.segments; i++) {
						num = parseInt(parts[i], ver.radix);
						if(num < 0 || num > ver.upper)
							return false;
					}

					return true;
				}
			},

			errors =  window.NinjaContactFormOpts ?
				window.NinjaContactFormOpts.errors :
			{
				required: "* Please enter %%",
				min: "* %% must have at least %% characters.",
				max: "* %% can have at most %% characters.",
				matches: "* %% must match %%.",
				less: "* %% must be less than %%",
				greater: "* %% must be greater than %%.",
				numeric: "* %% must be numeric.",
				email: "* %% must be a valid email address.",
				ip: "* %% must be a valid ip address.",
				answer: "* Wrong %%"
			};

		/* Data API Definitions
		 * ==================== */

		$(function() {
			if(!defaults.use_api)
				return;

			$("html").on("submit", defaults.api_selector, defaults.api_fn);
		});

		/* Helper functions
		 * ================ */

		function extract(el) {
			return el.type === "checkbox" ? el.checked : $(el).val();
		}

		function processError(fn, name, params) {
			var errorstr = errors[fn];
			params.unshift(name);

			while(params.length)
				errorstr = errorstr.replace(/%%/, params.shift());

			return errorstr;
		}

		function capitaliseFirstLetter(string)
		{
			return string.charAt(0).toUpperCase() + string.slice(1);
		}

		/* API Declarations
		 * ================ */

		$.fn.jvalidator = function(options) {
			var opts = $.extend({}, defaults, options),
				form = {},
				context = { opts: opts, form: form },
				errors = [],
				fields = $(opts.fields, this),
				error;

			//Loop to store the existing form data for validation.
			fields.filter("[" + opts.field_attr + "]").each(function() {
				form[this.name] = extract(this);
			});

			//Loop to validate each field.
			fields.filter("[data-rules]").each(function() {
				var t = $(this),
					rules = t.data("rules").split("|"),
					regex = /^(.+)\[(.+)\]$/,
					i = 0, match, fn, params;

				//Set the value of the field for the context.
				context.obj = t;
				context.field = extract(this);
				//Loop through each rule.
				for(; i < rules.length; i++) {
					if((match = rules[i].match(regex))) {
						fn = match[1];
						params = match[2].split(",");
					} else {
						fn = rules[i];
						params = [];
					}

					if(!functions[fn].apply(context, params)) {
						error = processError(fn, t.data("name") || this[opts.field_attr], params);
						opts.error_fn(t, error);
						errors.push(error);
					}
				}
			});

			//Return the final result set.
			return {
				valid: !errors.length,
				errors: errors,
				fields: form
			};
		};

		$.fn.jvalidator.defaults = defaults;
		$.fn.jvalidator.errors = errors;
		$.fn.jvalidator.functions = functions;
	})($);

	// main logic, human readable
	setTimeout(function () {

		var console = window.console && window.NKS_DEBUG ? window.console : {log: function(){}};

		var NinjaSidebar = window.NinjaSidebar || (function () {
			var opts = window.NinjaContactFormOpts;
			var TYPE = opts.sidebar_type;

			// caching
			var $win = $(window);
			var $html = $('html');
			var $body = $('body');
			var b = document.body;
			var $labels = $('.nks_cc_trigger_tabs')
			var $label = $labels.filter('.ncf_tab'); // delegate to Panel if exists
				debugger
			var $icon = $labels.find('.ncf-tab-icon');
			var $overlay = $('#ncf-overlay-wrapper').appendTo($body);
			var $overlayIn = $overlay.children();
			var $sidebar = $('#ncf_sidebar');
			var $scrollable = $sidebar.find('.ncf_sidebar_cont_scrollable');
			var $cont = $sidebar.find('.ncf_sidebar_cont');
			var $social = $sidebar.find('.ncf_sidebar_socialbar');
			var $form = $sidebar.find('form.ncf_form');
			var $formResult = $('.ncf_form_result');
			var $bodybg;
			var $bodychildren = $body.children().not('[id*=ncf], script, style').filter(':visible');
			var bodyCss;
			var $defaults;
			console.log($label.length)

			var transProp = getVendorPropertyName('transform');
			var direction = opts.sidebar_pos;
			var sidebarW = 500;
			var opposite = direction === 'left' ? 'right' : 'left';
			var processingRequest = false;
			var webkit = /safari|chrome/.test(navigator.userAgent.toLowerCase());
			var isMobile = /Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i.test(navigator.userAgent);
			// var isIOS = isMobile ? /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 : false;
			var isIOS = false; // todo check
			var isAnimated = false;
			var isExposed = false;
			var isIE = /msie|trident.*rv\:11\./.test(navigator.userAgent.toLowerCase());
			var isFF = /firefox/.test(navigator.userAgent.toLowerCase());
			var translation = _T.translate((direction === 'left' ? sidebarW : -sidebarW) , 0);
			var defTranslationStr = _T.toString(_T.translate(0, 0));
			var currentW = $win.width();
			var htmlMargins = {
				top: parseInt($html.css('marginTop')),
				bottom: parseInt($html.css('marginBottom'))
			}

			var answer;
			var _selectIndex = 0;
			var _h = 0;

			for (var prop in htmlMargins) {
				if (isNaN(htmlMargins[prop])) {
					htmlMargins[prop] = 0;
				}
			}

			$bodybg = $('#ncf-body-bg');

			if (TYPE === 'push') {
				$bodychildren.each(function(i, el){
					var $t = $(this);
					var z;
					var pos = $t.css('position');

					if (pos === 'fixed') {
						z = $t.css('zIndex');
						if (z !== 'auto' && z < 0) {
							$t.insertAfter($bodybg).css('zIndex', 0);
						}
					}

//				  if (pos !== 'fixed' && pos !== 'absolute') {
//					 _h += $t[0].scrollHeight;
//				  }
				});
			}

			if (NKS_DEBUG) {
//				$('<div id="ncf-fixed">').prependTo('#container');
//				$('<div id="ncf-fixed2">').appendTo('#footer #footer-wrapper');
//			  $('<div id="nks-fixed-bg">').appendTo($body);
			}

			function init() {
				populateSocialBarWith(opts.social, opts.theme);

				$icon.on('click touchstart', function(e){
					if (isExposed) hideSidebar($(this))
					else showSidebar($(this));
					return false;
				});
				
				$('.ncf_trigger_element').add(opts.togglers).click(function(){
					if (isExposed) hideSidebar($(this))
					else showSidebar($(this));
					return false;
				});

				$body.delegate('.ncf_trigger_element', 'click tap', function(){
					if (isExposed) hideSidebar($(this))
					else showSidebar($(this));
					return false;
				})

				if (opts.label_mouseover) {
					$icon.mouseover(function () {
						if (!isExposed) NinjaSidebar.showSidebar($(this))
					})
				}

				$overlayIn.click(function(){hideSidebar()});

				var bodyClasses = 'ncf_hidden ncf_on ncf_sidebar_' + TYPE + ' ncf_sidebar_pos_' + direction;

				if (isIE) {
					bodyClasses += ' ncf_msie';
				}

				if (webkit) {
					bodyClasses += ' ncf_webkit'
				}

				if (isMobile) {
					bodyClasses += ' ncf_mobile';
					$html.attr('style', 'overflow-x: hidden !important')
				}

				if (isIOS) {
					bodyClasses += ' ncf_ios';
				}

				$body.addClass(bodyClasses);

				$( document ).ajaxComplete(function() {
				  setTimeout(function(){
					if(!$body.is('.ncf_on')) {
					  $body.addClass(bodyClasses + (isExposed ? ' ncf_exposed' : ''));
					}
				  }, 0);
				});

				if ($sidebar.find('.wpcf7-form').length) {
                    // TODO add multiple select support
					$('.wpcf7-form-control-wrap').each(function(){
						var $t = $(this);
						var $textInput = $t.find("input, textarea").not(':radio, :checkbox').add($t.find('.wpcf7-acceptance'));
						var $label = $t.parent().find('> label');
						var id;
						if ($textInput.length) {
							if ($label.length) {
								if ( !$textInput.attr('id') && !$label.attr('for') ) {
									id = $textInput.attr('name') + _selectIndex++;
									$textInput.attr('id', id);
									$label.attr('for', id);
								}
							} else {
								if ($textInput.is('.wpcf7-acceptance')) {
									id = $textInput.attr('name') + _selectIndex++;
									$textInput.after('<label class="wpcf7-list-item-label" for="'+ id +'"></label> ');
								}
							}
							$t.append($label).addClass('ncf_ph');
						}
					})

					$('.wpcf7-list-item-label').each(function(i, el) {
						var $t = $(this);
						var $inp = $t.prev('input:first');
						var txt = $t.text();
						var id = $t.siblings('input:first').attr('name') + _selectIndex++;

						$inp.attr('id', id);

						$(this).replaceWith('<label class="wpcf7-list-item-label" for="'+ id +'">' + txt + '</label> ');
					});

					$('.wpcf7-captchac, .wpcf7-submit').closest('p').addClass('wpcf7-ta-wrap');

				}

				$sidebar.find('select').each(function(i, el) {
					$(this).parent().addClass('ncf_select_wrap');
				});

				$sidebar
					.find('a.ncf_button').click(function(){
						//$('.ncf_err_msg:visible').css('left', 3).animate(cssObject('left', 0), {duration:200});
						var $form = $(this).closest('form');
						var results = $form.jvalidator({error_fn: showErrors});
						if (results.valid) {
							$form.submit();
						} else {
						}
						return false;
					});
				 $sidebar.find('input')
					.keydown(function(e){
						if (e.which == 13) {
							var $form = $(this).closest('form');
							var results = $form.jvalidator({error_fn: showErrors});
							if (results.valid) {
								$form.submit();
							}
							return false;
						}
					})
					.add($sidebar.find('textarea'))
					.bind('input', function(){
						 var $t = $(this);
						 var $p = $t.parent();
						 var val = this.value;
						 var hasClass = $p.is('.ncf_has_value');
						 var $err = $p.find('.ncf_err_msg:visible');
						 if (val === '') {
							 if (hasClass) {
								 $p.removeClass('ncf_has_value');
							 }
						 } else {
							 if (!hasClass) {
								 $p.addClass('ncf_has_value');
							 }
						 }
						 if ($err.length) $err.slideUp();
					 });

				if (/iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1) {
					$sidebar.find("input, select, textarea").on('focus', function(e) {
						e.preventDefault();
						return false;
					})
				}

				// reset inputs
				setTimeout(function(){$form.find('input, textarea').not(':hidden').val('')}, 0);

				$form.submit(function(e){
					if (processingRequest) return false;
					processingRequest = true;
					var $t = $(this);
					var id = $t.closest('.ncf_form_wrapper').attr('data-index');

					var $btn = $t.find('.ncf_button').find('span');
					var sendT = $btn.text();
					$btn.html(opts.sending_text + '...');

					(function blink(){
						blink.cacheOp = blink.cacheOp === 1 ? 0.5 : 1;
						$btn.fadeTo(400, blink.cacheOp, blink);
					})();

					console.log($t.serialize())

					$.ajax({
						type: "post",
						url: opts.ajaxurl,
						data: $t.serialize(),
						dataType: "json",
						success: function(response) {
							console.log()
							processingRequest = false;
							$btn.stop().css('opacity', 1).html(sendT);

							if (response.success) {
								opts['callbacks']['id' + id] && opts['callbacks']['id' + id]();
							}

							$t.fadeOut(200, function(){
								var btnClass = opts.theme === 'flat' ? 'ncf_color8' : 'ncf_color1';
								$formResult.html(
									'<p class="ncf_form_res_message">' + (response.success ? opts['id' + id]['success'] : opts['msg_fail_text']) +'</p>' +
										'<p class="ncf_btn_wrapper"><a class="ncf_button ncf_btn_more '+ btnClass + '" href="#"><span>'+ (response.success ? opts.send_more_text : opts.try_again_text) + '</span></a></p>' +
										'<p class="ncf_btn_wrapper"><a class="ncf_button ncf_btn_close '+ btnClass + '" href="#"><span>'+ opts.close_text + '</span></a></p>'
								).fadeIn();
							})
						},
						error: function(){
							processingRequest = false;
							$btn.stop().css('opacity', 1).html(sendT);
							$t.fadeOut(200, function(){
								var btnClass = opts.theme === 'flat' ? 'ncf_color8' : 'ncf_color1';
								$formResult.html('<p class="ncf_form_res_message">'+ opts['msg_fail_text'] + '</p>' +
									'<p class="ncf_btn_wrapper"><a class="ncf_button ncf_btn_more '+ btnClass + '" href="#">'+ opts.try_again_text + '</a></p>' +
									'<p class="ncf_btn_wrapper"><a class="ncf_button ncf_btn_close '+ btnClass + '" href="#">'+ opts.close_text + '</a></p>'
								).fadeIn()
							})
						}
					});
					return false; // prevent default
				});

				$cont.delegate('a', 'click', function(){
					var $t = $(this);
					if ($t.is('.ncf_btn_more')) {
						$formResult.fadeOut(200, function(){
							$form.fadeIn(200);
						})
						return false;
					} else if ($t.is('.ncf_btn_close')) {
						hideSidebar(null, function () {
							$formResult.hide();
							$form.show();
						});
						return false
					}
				});

				if (opts.humantest){
					(function(){
						var number1 = Math.min(Math.ceil(Math.random() * 10),9);
						var number2 = Math.min(Math.ceil(Math.random() * 10),9);
						answer = number1 + number2;
						$('#ncf_question').html(number1 + ' + ' + number2 + ' = ?');
						$('#ncf_answer_field').attr('data-rules', 'required|numeric|answer[' + answer +']');
					}())
				}

				if (opts.label_vis === 'scroll') {
					$win.one('scroll', function(){
						$label.removeClass('ncf_label_scroll')
					});
				} else if (opts.label_scroll_selector && opts.label_vis.indexOf('scroll') != -1 ) {
					var $elToScroll = $(opts.label_scroll_selector).eq(0);
					var scrlFn = function(){
						if (isScrolledIntoView($elToScroll)) {
							$label.removeClass('ncf_label_scroll_into');
							$win.unbind('scroll', scrlFn)
						}
					}
                    if ($elToScroll.length) {
                        $win.scroll(scrlFn).scroll();
                    } else {
                        $win.one('scroll', function(){
                            $label.removeClass('ncf_label_scroll_into')
                        });
                    }
				}

				// themes specific
				if (opts.theme !== 'minimalistic' && opts.flat_socialbar === 'bottom') {
					$social.each(function(){
						$(this).parent().append($social);
					});
				}

				if(opts.theme === 'aerial') {
					$form.find('.ncf_form_input_wrapper :input').focusin(function(){
						$(this).parent().addClass('ncf_focusin');
					}).focusout(function(){
						$(this).parent().removeClass('ncf_focusin');
					});
				}

				$win.resize(resize);
				$cont.css({minHeight: $cont.height()});

				if (isMobile) attachSwipesHandler();

				if ( window.ncf_transitionEnd ) {
					(TYPE === 'push' ? $bodybg : $sidebar).bind( window.ncf_transitionEnd , function(e){
						var $fixed;

						if (!$(e.target).is((TYPE === 'push' ? $bodybg : $sidebar))) return;

						if ($body.is('.ncf_exposed')) {

							if (isMobile) setTimeout(function(){$sidebar.css('-webkit-overflow-scrolling', 'touch')}, 100);
							isExposed = true;

						} else  {

							$body.unbind('mousewheel DOMMouseScroll', freezeBody);
							$cont.css({'transform' : '', 'margin': '', 'width': ''}).addClass('ncf_shrinked');
							$body.addClass('ncf_hidden').find('.ncf-active').removeClass('ncf-active');
							if (isMobile) $sidebar.css('-webkit-overflow-scrolling', '');
							$overlay.css('visibility', 'hidden');
							isExposed = false;

							$fixed = $('.ncf_fixed_inner_el')
							if (!isIE && TYPE === 'push') $fixed.each(unshiftFixed);
							$fixed.removeClass('ncf_fixed_inner_el');

						}
						$body.removeClass('ncf_transitioning')
						isAnimated = false;
					});
				} else {

				}

				$icon.mouseenter(function(){
					$icon.addClass('nks-hover')
					//if (isExposed /*&& !$t.is('.nks-active')*/) $t.parent().addClass('nks-hover')
				}).mouseleave(function(){
					$icon.removeClass('nks-hover')
				})

				if (TYPE === 'push' && !opts.isBgFixed) {

//			    _h = Math.max(
//				    b.scrollHeight, document.documentElement.scrollHeight,
//				    b.offsetHeight, document.documentElement.offsetHeight,
//				    b.clientHeight, document.documentElement.clientHeight
//			    )

//			    _h = _h - htmlMargins.top - htmlMargins.bottom;

//			    $bodybg.height(_h);
				}

				$defaults = $sidebar.find('.ncf_default_form');

				if (!$defaults.length) {
					$sidebar.find('.ncf_form_wrapper:first').addClass('ncf_default_form');
				} else if ($defaults.length > 1){
					$defaults.not(':last').removeClass('ncf_default_form');
				}

				$bodybg.before($sidebar);
				$bodybg/*.add($sidebar)*/.add($label).show();

				NinjaSidebar.init = function () {};
				return this;
			}

			function showSidebar ($el, callback) {

				if (isAnimated || isExposed) return;
				else isAnimated = true;

				var ww = window.innerWidth || $win.width();
				var _tr;
				var $active;
				var $children = $body.children().not('#ncf_sidebar, [id*=nks], script, style');
				var tab;
				var coof, margin, css, iosCss;
				var selector;

        if ($el && $el.is('.ncf_trigger_element')) {
          selector = $el.attr('class').match(/ncf_toggle_form_(\d+)/);
          console.log( $el.attr('class'), selector)
          selector = selector ? '.ncf_form_' + selector[1] : '.ncf_default_form';
          $active = $cont.find(selector);

        } else {
          $active = $cont.find('.ncf_default_form');
        }
        $cont.find('.ncf_form_wrapper').hide();
        $active.show();
        $sidebar.addClass('ncf_active_' + $active.attr('data-index'))

        $scrollable.scrollTop(0);

				$icon.mouseleave();

				if (opts.scroll === 'custom') $scrollable.bind('mousewheel DOMMouseScroll', freezeBodyScroll);

				if (TYPE === 'push' && $.fn.layerSlider) $('div[id*=layerslider]').layerSlider('stop');
				if (TYPE === 'push' && $.fn.revpause) $('.rev_slider').revpause();

				if (isIOS) {
					var iosCss = {};
					iosCss[transProp] = _T.toString(_T.translate(0 , $win.scrollTop()))
					$scrollable.css(iosCss);
				}

				if ( ww < sidebarW + 40) {
					if (TYPE === 'push') {
						//$sidebar.width( ww );
						//$cont.width( ww - 60 );
						_tr = _T.translate((direction === 'left' ? ww-60 : 60-ww) , 0);

						$children.each(function(){
							var $el = $(this);
							var t = $el.css(transProp);
							var n;
							if (t !== 'none') {
								$el.data('ncf-old-matrix', t);
								t = _T.fromString(t);
								n = t.x(_tr); // add translation
								css = {};
								css[transProp] = _T.toString(n);
								$el.css(css).data('ncf-transformed', 1);
							} else {
								css = {};
								css[transProp] = _T.toString(_tr);
								$el.css(css).data('ncf-transformed', 1);
							}
						})

					} else {
						$sidebar.add($scrollable).width( ww - 60 );
						css = {};
						css[transProp] = _T.toString(_T.translate((direction === 'left' ? ww - 65 : 65 - ww) , 0));
						$labels.css(css).data('ncf-adjusted', 1)
					}

					coof = ww > 400 ? ww / 500 : ((ww - 60) / 400);
					margin = ww > 400 ? (direction === 'left' ? ('30px auto 30px ' + (ww / 24) +  'px') : ('30px ' + (ww / 24) + 'px 30px auto') ) : 0;
					css = {'margin': margin};
					console.log('coof',ww > 400, coof)
					if (coof <= 1) css[transProp] = 'scale(' + coof + ', ' + coof + ')';
					$cont.css(css);
				}

				if (TYPE === 'push') {
					$children.each(function(){
						var $el = $(this);
						var t = $el.css(transProp);
						var n;
						if (t !== 'none' && !$el.data('ncf-transformed')) {
							$el.data('ncf-old-matrix', t);
							t = _T.fromString(t);
							n = t.x(translation); // add translation
							css = {};
							css[transProp] = _T.toString(n);
							$el.css(css);
						}
					});
				} else {
          $sidebar.show();
        }


				if (opts.scroll === 'custom') $body.on('mousewheel DOMMouseScroll', freezeBody);

				if (TYPE === 'push') {
          var scrollTop = $win.scrollTop();
          var scrollLeft = $win.scrollLeft();
					$children.find('*').each(function(i, el) {
						shiftFixed(i, el, scrollTop, scrollLeft);
					});
				}

				$overlay.css('visibility', 'visible');

				$cont.removeClass('ncf_shrinked');

				if ( !window.ncf_transitionEnd ) {
					setTimeout(function(){
						$body.removeClass('ncf_transitioning')
						isAnimated = false;
						//if (isMobile) $sidebar.css('-webkit-overflow-scrolling', 'touch');
						isExposed = true;
					}, 400)
				}

        setTimeout(function(){
          $body
            .removeClass('ncf_hidden')
            .addClass('ncf_exposed ncf_transitioning');
        },14)

				if (typeof callback === 'function') callback();
			}

			function hideSidebar ($el, callback) {

				var $fixed;
				var $active;

				if ($el) {

					if ($el.is('.nks-tab') && !$el.is('.nks-active')) {
						$active = $cont.find('#' + $el.attr('id').replace('tab', 'content'));
						$body.find('.nks-active').removeClass('nks-active');
						$active.add($el).addClass('nks-active');
						$active.find('.nks-shrinked').removeClass('nks-shrinked')

						$scrollable.scrollTop(0);
						return false;
					}
				}

				if (isAnimated || !isExposed) return
				else isAnimated = true;

				$scrollable.unbind('mousewheel DOMMouseScroll', freezeBodyScroll);

				$body.removeClass('ncf_exposed').addClass('ncf_transitioning');

				if ($labels.data('ncf-adjusted')) $labels.css(transProp, '').data('ncf-adjusted', '')

				if (TYPE === 'push') {
					$body.children().not('#ncf_sidebar, script, style').each(function(){
						var $el = $(this);
						if ($el.data('ncf-old-matrix')) {
							$el.css(transProp, $el.data('ncf-old-matrix')).data('ncf-old-matrix', '');
						} else {
							$el.css(transProp, '').data('ncf-transformed', '');
						}
					})
				}

				$fixed = $('.ncf_fixed_inner_el');
				if (isIE && TYPE === 'push') $fixed.each(unshiftFixed);

				$icon.mouseleave();

//				if ($.fn.layerSlider) $('div[id*=layerslider]').layerSlider('start');

				if ( !window.ncf_transitionEnd ) {

					if (TYPE === 'push') $fixed.each(unshiftFixed).removeClass('ncf_fixed_inner_el');

					setTimeout(function(){
						$body.unbind('mousewheel DOMMouseScroll', freezeBody).addClass('ncf_hidden');
						$cont
							.addClass('ncf_shrinked')
							.css({'transform' : 'scale(1,1)', 'margin': '', 'width': ''});
						$body.find('.nks-active').removeClass('nks-active');
						$overlay.css('visibility', 'visible');
						if (isMobile) $sidebar.css('-webkit-overflow-scrolling', '');
						$body.removeClass('ncf_transitioning');
						isExposed = false;
						isAnimated = false;
					}, 400)
				}

				setTimeout(function(){
					if (typeof callback === 'function') callback();
				}, 400)
			}

			function populateSocialBarWith (social, theme) {
				$social.each(function(){

					var $t = $(this);
					var $items = $t.find('li');
					var len = $items.length;
					var href;
					var name;
					var index = 0;
					var _social = social[$t.parents('.ncf_form_wrapper').attr('data-index')]

					for (name in _social) {
						if (_social.hasOwnProperty(name)) {
							index++;
						}
					}

					if (index === 0 && theme === 'minimalistic') {
						$t.add('.ncf_line_sep:last').hide();
					}

					for (name in _social) {
						if(_social.hasOwnProperty(name) && index >= 0) {
							href = _social[name];
							$('<a class="'+ name + '" href="'+ href +'" target="_blank"></a>').appendTo($items.eq(len - index));
							index--;
						}
					}

					if (theme !== 'flat') {
						$t.find('li:empty').remove();
					}
				})

			}

			function showErrors(input, error) {
				var $t = $(input);
				var $parent = $t.parent();
				var $err = $parent.has('.ncf_err_msg').length ? $parent.find('.ncf_err_msg') : $('<div class="ncf_err_msg"></div>').appendTo($parent);

				if (!$err.is(':visible')) {
					$err.html(error).slideDown( 200 );
				}
			}

			function shiftFixed(i, el, scrollTop, scrollLeft, bh, wh) {

				var $t = $(el);
				var $offsetP;
				var t;
				var nu;
				var offset;
				var oLeft;
				var oTop;
				var coords;
				var newCSS;
				var _b;
				var transf;

				if ($t.css('position') === 'fixed') {

					$t.addClass('ncf_fixed_inner_el')

					if (isIE) {

						t = $t.css(transProp);

						if (t !== 'none') {
							$t.data('ncf-old-matrix', t);
							t = _T.fromString(t);
							nu = t.x(translation); // add translation
							$t.css(transProp,  _T.toString(nu)).data('ncf-transformed', 1);
						} else {
							$t.css(transProp, _T.toString(translation)/*, transition: trans + 'transform 0.5s cubic-bezier(0.645, 0.045, 0.355, 1)', transitionDelay: '90ms'*/).data('ncf-transformed', 1);
						}

					} else {

						$offsetP = $t;

						while ($offsetP = $offsetP.parent()) {
							transf = $offsetP.css(transProp);
							if ((transf && transf !== 'none') || $offsetP.is('body')) {
								break
							}
						}

						offset = $offsetP.offset();
						oLeft = offset.left;
						oTop = offset.top;
//if (oTop === htmlMargins.top) oTop = 0;

						if (isFF && $t.is(':visible')) {
							$t.hide().data('ncf-ff-hidden', 1);
						}

						coords = {
							left : $t.css('left'),
							right : $t.css('right'),
							top : $t.css('top'),
							bottom : $t.css('bottom')
						}

						if (isFF && $t.data('ncf-ff-hidden')) $t.show();

						newCSS = {};
						_b = parseInt(coords.bottom);
						_b = isNaN(_b) ? 0 : _b;

						if (coords.left !== 'auto') {
							coords.toChangeHor = 'left';
							newCSS[coords.toChangeHor] = '-=' + (oLeft - scrollLeft);
						} else if (coords.right !== 'auto') {
							coords.toChangeHor = 'right';
							newCSS[coords.toChangeHor] = '-=' + (oLeft - scrollLeft);
						} else {
							coords.toChangeHor = 'left'
						}

						if (coords.top !== 'auto') {
							coords.toChangeVert = 'top';
							newCSS[coords.toChangeVert] = oTop - scrollTop > 0 ? parseInt(coords.top) - (oTop - scrollTop) :  parseInt(coords.top) + (scrollTop - oTop);
						} else if (coords.bottom !== 'auto') {
							coords.toChangeVert = 'bottom';
							newCSS[coords.toChangeVert] = $body.height() + htmlMargins.top + htmlMargins.bottom + _b - $win.height() - scrollTop + 'px';
						} else {
							coords.toChangeVert = 'top';
							newCSS[coords.toChangeVert] = scrollTop;
						}

						newCSS['transitionProperty'] = 'none';

						//console.log(el, coords, newCSS, oTop, scrollTop)

						$t.css(newCSS).data('ncf-old-pos', coords)
					}
				}
			}

			function unshiftFixed(i, el) {
				var $el = $(el);
				var coords;
				var newCss;
				if (isIE) {
					if ($el.data('ncf-old-matrix')) {
						$el.css(transProp, $el.data('ncf-old-matrix')).data('ncf-old-matrix', '');
					} else {
						$el.css(transProp, defTranslationStr).data('ncf-transformed', '');
					}
				} else {
					coords = $el.data('ncf-old-pos');
					newCss = {};
					if (coords) {
						newCss[coords.toChangeHor] = coords[coords.toChangeHor];
						newCss[coords.toChangeVert] = coords[coords.toChangeVert];
						newCss['transitionProperty'] = '';
						if (coords.toChangeVert === 'bottom') newCss['top'] = '';
						$el.css(newCss);
						$el.data('ncf-old-pos', '');
					} else {
						$el.css({left: '', top: '', bottom: '', right: '', 'transitionProperty' : ''})
					}
				}
			}

			function isScrolledIntoView($elem) {
				var docViewTop = $win.scrollTop();
				var docViewBottom = docViewTop + $win.height();

				var elemTop = $elem.offset().top;
				var elemBottom = elemTop /*+ $elem.height()*/; // when element scrolls into view

				return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
			}

			function resize() {
				var ww;
				var $children;
				var coof, margin, css;

				if (isExposed) {

					$children = $body.children().not('#ncf_sidebar, script, style');
					ww = $win.width();

					if (ww < sidebarW + 40) {

						if (TYPE === 'push') {
							$children.each(function(){
								var $el = $(this);
								var t = $el.css(transProp);
								if (t !== 'none' && currentW !== ww) {
									$el.css(transProp, _T.toString(_T.translate( direction === 'left' ? ww - 60 : 60 - ww , 0)));
								}
							});
						} else {
							$sidebar.add($scrollable).width( ww - 60 );
						}

//					  $sidebar.width(ww);
//					  $cont.width(ww - 60);

						coof = ww > 400 ? ww / 500 : ((ww - 60) / 400);
						margin = ww > 400 ? (direction === 'left' ? ('30px auto 30px ' + (ww / 24) +  'px') : ('30px ' + (ww / 24) + 'px 30px auto') ) : 0;
						css = {'margin': margin};
						if (coof <= 1) css[transProp] = 'scale(' + coof + ', ' + coof + ')';
						console.log(css);
						$cont.css(css);

					} else {

						if (TYPE === 'push') {
							$children.each(function(){
								var $el = $(this);
								$el.css(transProp, _T.toString(translation));
							});
							//$cont.css(transProp, 'scale(1,1)').css('margin', '');
						}
						//$sidebar.add($cont).width('');
						css = {'margin': ''};
						css[transProp] = 'scale(1,1)';
						$cont.css(css);
					}
					currentW = ww;

				}

				if (!opts.isBgFixed) {
					$bodybg.css({'height' : $body.outerHeight() /*+ htmlMargins.top, top: 0 - htmlMargins.top*/});
				}
			}

			function attachSwipesHandler() {
				var startX, startY, startTime, moveX, moveY;
				$sidebar.add($overlayIn).bind('touchstart', function (e) {
					if (isExposed) {
						startTime = (new Date).getTime();
						startX = e.originalEvent.touches[0].pageX;
						startY = e.originalEvent.touches[0].clientY;
					}
				})
					.bind('touchmove', function (e) {
						if (isExposed) {
							moveX = e.originalEvent.touches[0].pageX;
							moveY = e.originalEvent.touches[0].clientY
						}
					})
					.bind('touchend', function () {
						if (isExposed) {
							var swipeDirection = moveX > startX ? "right" : "left";
							var finalY = moveY - startY > 30 || -30 > moveY - startY;
							var finalX = moveX - startX > 60 || -60 > moveX - startX;
							var now = (new Date).getTime();
							if (!(now - startTime > 300 || finalY) && finalX) {
								switch (swipeDirection) {
									case "left":
										"left" === direction ? hideSidebar() : showSidebar();
										break;
									case "right":
										"left" === direction ? showSidebar() : hideSidebar()
								}
							}
						}
					});
			}

			function freezeBodyScroll(e) {
				var scrollTo = null;

				if (e.type == 'mousewheel') {
					scrollTo = (e.originalEvent.wheelDelta * -1);
				}
				else if (e.type == 'DOMMouseScroll') {
					scrollTo = 40 * e.originalEvent.detail;
				}

				if (scrollTo) {
					e.preventDefault();
					$(this).scrollTop(scrollTo + $(this).scrollTop());
				}
			}

			function freezeBody(e) {
				if (e.type == 'mousewheel' || e.type == 'DOMMouseScroll') {
					e.preventDefault()
				}
			}

			function rePos(sfield){
				var yPos = window.pageYOffset || document.documentElement.scollTop;
				setTimeout(function() {window.scrollTo(0, yPos);},0);
			}

			function visible () {
				return isExposed
			}

			function getVendorPropertyName (prop) {

				var prefixes = ['Moz', 'Webkit', 'O', 'ms'],
					vendorProp, i,
					div = document.createElement('div'),
					prop_ = prop.charAt(0).toUpperCase() + prop.substr(1);

				if (prop in div.style) {
					return prop;
				}

				for (i = 0; i < prefixes.length; ++i) {

					vendorProp = prefixes[i] + prop_;

					if (vendorProp in div.style) {
						return vendorProp;
					}

				}

				// Avoid memory leak in IE.
				this.div = null;
			};

			return {
				init: init,
				showSidebar: showSidebar,
				hideSidebar: hideSidebar,
				visible: visible
			}
		}());

		window.NinjaSidebar = NinjaSidebar.init();

    if (location.search && location.search.indexOf('open_sidebar=1') !== -1) {
      NinjaSidebar.showSidebar()
    }

	}, 0);

});