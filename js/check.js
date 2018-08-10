// JavaScript Document
$(function(){
	x=101;
	
	login=function(e){
		e.preventDefault();
		var pwd=$('#pwd').val(),
		usr=$('#usr').val(),
		url=$(this).closest('form').attr('action');
		$('#feedback').html('<center><img src="../images/r.gif" width="20px"></center>');
		$.post(url,{'usr':usr,'pwd':pwd},function(data){
		//alert(usr);
			if(data==x){
				window.location=e.data.referer;
			}else{
				
				$('div #feedback').html(data);
				}
			});
		
		}
	
	uploadfile=function(e){
		e.preventDefault();
			
			var fdta=new FormData($('form:file')[0]);
			$.each($('#pfile')[0].files,function(i,file){
				fdta.append('file',file);
				});
				//fdta.serialize();
			
				$.ajax({
					url: '../process/uaskl.php',
           			type: 'POST',
            		data: fdta,
					contentType:false,
					processData:false,
					cache:false,
					beforeSend:function(evt){
						
							
								$('#feedback').html('<center><img src="../images/r.gif" width="20px"></center>');
								
						},
					error:function(){
						alert('An Error Occured, Try Again');
						},
            		success: function (data) {
						if(data==x){
							$('#feedback').empty().html('<b><img src="../images/r.gif" width="20px">&nbsp;<span style="color:green;">File Ready</span>:Waiting For Other Fields For Submission.</b>');
							
						}else{
							$('#feedback').html(data);
							}
					}
        			});
		
		
		}
	
	addclient=function(e){
		e.preventDefault();
		var sname=$('#sname').val(),
		tel=$('#tel').val(),
		oname=$('#oname').val(),
		addr=$('#addr').val(),
		nextofkin=$('#nextofkin').val(),
		addrnextofkin=$('#addrnextofkin').val(),
		dob=$('#dob').val(),
		sex=$('#sex').val(),
		rel=$('#rel').val(),
		url=$(this).closest('form').attr('action');
		//alert(name);
		
		$('#feedback').html('<center><img src="../images/r.gif" width="20px">	Creating Account...</center>');
		$.post(url,{'sname':sname,'tel':tel,'oname':oname,'addr':addr,'addrnextofkin':addrnextofkin,'dob':dob,'sex':sex,'rel':rel,'nextofkin':nextofkin,'sex':sex,'pid':1},function(data){
			if(data==x){
				window.location='details.php';
			}else{
				$('#feedback').html(data);
			}
			
			});
		}
	
	
	
		getnode=function(event){
			
		event.preventDefault();
		var section=$('#section').val(),
		cat=$('#cat').val(),
		url='../process/retrieve.php';
		$.post(url,{'rtid':1,'section':section,'cat':cat},function(data){
			//alert(data);
			$('cc select').html(data);
			});
		} 	
			
        updatecharges=function(e){
			e.preventDefault();
			
			var charges=$(this).val(),
			id=this.getAttribute('data-ctid');
			
			utype=this.getAttribute('data-utype'),
			url='../process/update.php';
			;
			
			
			$('#feedback').html('<center><img src="../images/r.gif" width="20px">	Updating Bill...</center>');

			$.post(url,{'upid':1,'utype':utype,'charges':charges,'rowid':id},function(data){
				$('#feedback').html(data).delay(10000);
				
			});
			
			
			}   
        
			verifycardno=function(e){
				
				e.preventDefault();
				var card=$('#cardno').val(),
				url='../process/retrieve.php';
				
				$('#feedback').html('<center><img src="../images/r.gif" width="20px">	Verifying Card Details...</center>');

				$.post(url,{'cardno':card,'rtid':2},function(data){
					if(data==x){
						window.location='placeorder.php';	
					}else{
						$('#feedback').html(data);
					}
					
				});
			
			}
	
	
	
	
	
	
	
	
	
	
	/*additem=function(event){
		event.preventDefault();
		
		var title=$('#title').val(),
		isbn=$('#isbn').val(),
		author=$('#author').val(),
		pbyr=$('#pbyr').val(),
		pbby=$('#pbby').val(),
		cls=$('#class').val(),
		sbcls=$('#sbclass').val(),
		url=$(this).closest('form').attr('action');
		//alert(name);
		if(typeof(sbcls)=='undefined'){
			$('#feedback').html('<center><img src="../images/cancel.png" width="14px">	Cannot Proceed, No Subclass Defined!</center>');
			}else{
		$('#feedback').html('<center><img src="../images/r.gif" width="20px">	Adding To Library...</center>');
			$.post(url,{'title':title,'isbn':isbn,'author':author,'pbyr':pbyr,'pbby':pbby,'class':cls,'subclass':sbcls},function(data){
					$('#feedback').html(data);
					setTimeout(function(){
						window.location='addtolibrary.php';
						},5000);		
				});
			}
		}
	
	isearch=function(event){
		event.preventDefault();
		
		var flag=1;
		var sorter=$('#gsearch').val();
		var sx=$('#section').val();
		var url=$(this).closest('form').attr('action');

		$('#vlib table').html('<center><img src="../images/r.gif" width="20px">	Searching....</center>');
		
		$.post(url,{'searchid':flag,'section':sorter,'role':sx},function(data){
			//alert(data);
			$('#vlib table').html(data);
			
			});
		
		}
	addtocatalog=function(event){
		
		event.preventDefault();
		name=$('#classname').val();
		acr=$('#acr').val();
		
	 	url=$(this).closest('form').attr('action');

		$('#feedback').html('<center><img src="../images/r.gif" width="20px">	Adding To Catalog....</center>');
		
		$.post(url,{'classname':name,'acr':acr,'from':1},function(data){
			//alert(data);
			if(data==x){
				
				$('#right cc').html('<center><img src="../images/r.gif" width="20px">	Updating Catalog....</center>');
				
				$.post('../process/retrieve.php',{'retrieveid':1},function(data){
					$('#feedback').empty();
					$('#right cc').html(data);
					});
				}else{
					$('#feedback').html(data);
					}
			
			});

		}
		
	opensubclass=function(event){
		
		var classid=$(this).data('group');
		$('scc').css({visibility:'visible'}).slideToggle('fast');
		
		$('subclass').css({visibility:'visible'}).slideToggle('fast');
		$('#hiddensubfield').val(classid);
		
				$('#right scc').html('<center><img src="../images/r.gif" width="20px">	Updating Catalog....</center>');
				
				$.post('../process/retrieve.php',{'retrieveid':2,'clsid':classid},function(data){
					$('#feedback').empty();
					$('#right scc').html(data);
					});

		
		
		$('cc').css({display:'none'}).hide('fast');
		$('main').css({display:'none'}).hide('fast');
		
		
		
		//alert(classid);
		}
	
	addsubclass=function(){
		
		event.preventDefault();
		name=$('#sbclassname').val();
		acr=$('#sbacr').val();
		dcls=$('#hiddensubfield').val();
	 	url=$(this).closest('form').attr('action');
		//alert(dcls);
		$('#feedback').html('<center><img src="../images/r.gif" width="20px">	Adding To Catalog....</center>');
		
		$.post(url,{'sbclassname':name,'sbacr':acr,'dcls':dcls,'from':2},function(data){
			//alert(data);
			if(data==x){
				
				$('#right scc').html('<center><img src="../images/r.gif" width="20px">	Updating Catalog....</center>');
				
				$.post('../process/retrieve.php',{'retrieveid':2,'clsid':dcls},function(data){
					$('#feedback').empty();
					$('#right scc').html(data);
					});
				}else{
					$('#feedback').html(data);
					}
			
			});

		}

	shelf=function(event){
		event.preventDefault();	
		var cls=$('#class').val();
		var sbcls=$('#sbclass').val();
		var url=$(this).closest('form').attr('action');
	
		$('#right cc ul').html('<center><img src="../images/r.gif" width="20px">	Searching Catalog....</center>');
		$.post(url,{'retrieveid':3,'class':cls,'sbclass':sbcls},function(data){
			
			$('#right cc').html(data);

			});
		}
	removefromshelf=function(){
		
		bk=$(this).data('id');
		cls=$('#class').val();
		sbcls=$('#sbclass').val();
		
		url='../process/deleteitems.php';
		
		$.post(url,{'deleteid':1,'bk':bk},function(data){
			
			if(data==x){
				$.post('../process/retrieve.php',{'retrieveid':3,'class':cls,'sbclass':sbcls},function(data){
					
						$('#right cc').html(data);
					
					});
			}else{
				$('#feedback').html(data);
				}
			
		});
		}
	
	searchusingcallno=function(){
		var callno=$('#callno').val(),
		url='../process/search.php';
		
		
		$('#right cc').html('<center><img src="../images/r.gif" width="20px">	Searching Library....</center>');
		
		$.post(url,{'searchid':2,'callno':callno},function(data){
			
			$('#right cc').html(data);
			
			});
		
		}

	iborrow=function(){
		bk=$(this).data('idr');
		cls=$('#class').val();
		sbcls=$('#sbclass').val();
		//alert(bk);
		url='../process/borrow.php';
		
		$('#feedback').html('<center><img src="../images/r.gif" width="20px">&nbsp;Requesting...</center>');
		
		$.post(url,{'bkid':bk,'cls':cls,'sbcls':sbcls},function(data){
			
				if(data==x){
					$('#feedback').html('<img src="../images/accept.png" width="13px" height="auto">&nbsp;<small>Request Sent! Meet The Libarian, Request Will Be Declined In The Next 48hrs</small>');
					
				$.post('../process/retrieve.php',{'retrieveid':3,'class':cls,'sbclass':sbcls},function(data){
					
						$('#right cc').html(data);
					
					});
			}else{
				//alert(data);
				$('#feedback').html(data);
				}
			});
		
		}
	
	acceptrequest=function(){
		var id=$(this).data('prq');
		url='../process/request.php';
		

		
		$.post(url,{'rqtype':1,'pid':id},function(data){
			
			if(data==x){
				alert('Successfully Borrowed');
				
				$.post('../process/retrieve.php',{'retrieveid':4},function(data){
					
						$('table').html(data);
					
					});

				
			}else{
				alert(data);
				}
			
			});
		
		}


	declinerequest=function(){
		var id=$(this).data('drq');
		url='../process/request.php';
		
		$.post(url,{'rqtype':2,'pid':id},function(data){
			
			if(data==x){
				alert('Successfully Declined');
				
				$.post('../process/retrieve.php',{'retrieveid':4},function(data){
					
						$('table').html(data);
					
					});

				
			}else{
				alert(data);
				}
			
			});
		
		}

	returntolib=function(){
		
	var id=$(this).data('bk'),
		url='../process/request.php';
		
		
		
		$.post(url,{'rqtype':3,'ibk':id},function(data){
			
			if(data==x){
				alert('Success');
				
				$.post('../process/retrieve.php',{'retrieveid':5},function(data){
					
						$('table').html(data);
					
					});

				
			}else{
				alert(data);
				}
			
			});
		
		}
*/

/************************End Function*************************************/


/* **********************|Binders|****************************************** */
	
	$('#sblogin').bind('click',{referer:'cpanel.php'},login);
	$('#sbaddclient').bind('click',addclient);
	$('#section').bind('change click',getnode);
	$('table').on('change','#upcharge',updatecharges);
	$('#pfile').bind('change',uploadfile);
	$('#vcard').bind('click',verifycardno);
//	$('#gsearch').bind('keyup',isearch);
//	$('#addclass').bind('click',addtocatalog);
//	$('p > a').bind('click',opensubclass);
//	$('#addsubclass').bind('click',addsubclass);
//	$('#exploreshelf').bind('click submit',shelf);
//	$('#right cc').on('click','a',removefromshelf);
//	$('#callno').bind('keyup',searchusingcallno);
//	$('#right cc').on('click','#bwbk',iborrow);
//	$('#acprq').bind('click',acceptrequest);
//	$('#dcrrq').bind('click',declinerequest);
//	$('#delbr').bind('click',returntolib);
	
	
	
});