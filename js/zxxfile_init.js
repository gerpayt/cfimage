var params = {
	fileInput: $("#fileImage").get(0),
	dragDrop: $("#fileDragArea").get(0),
	upButton: $("#fileSubmit").get(0),
	url: $("#uploadForm").attr("action"),
	filter: function(files) {
		var arrFiles = [];
		for (var i = 0, file; file = files[i]; i++) {
			if (file.type.indexOf("image") == 0 || (!file.type && /\.(?:jpg|png|gif)$/.test(file.name) /* for IE10 */)) {
				if (file.size >= 8*1024*1024) {
						alert('您这张"'+ file.name +'"图片大小过大，应小于8M');
					} else {
						arrFiles.push(file);
					}
				} else {
					alert('文件"' + file.name + '"不是图片。');
			}
		}
		return arrFiles;
	},
	
	onSelect: function(files) {
		var html = '', i = 0;
		$("#preview").html('<div class="upload_loading"></div>');
		var funAppendImage = function() {
			file = files[i];
			if (file) {
				var reader = new FileReader()
				reader.onload = function(e) {
					html = html + 
					'<div id="uploadList_'+i+'" class="row">' +
					'	<div class="span3">' +
					'		<div class="thumbnail">' +
					'			<img id="uploadImage_' + i + '" src="'+ e.target.result + '" alt="">' +
					'		</div>' +
					'	</div>' +
					'	<div class="span6 form-horizontal-narrow">' +
					'	<fieldset>' +
					'		<div class="control-group ">' +
					'			<label for="Folder_name" class="control-label required">Name <span class="required">*</span></label>' +
					'			<div class="controls"><input type="text" maxlength="256" id="title_'+i+'" value="'+file.name+'">' +
					'				<a href="javascript:" class="upload_delete btn btn-danger pull-right" data-index="'+ i +'">Delete</a></div>' +
					'			</div>' +
					'		<div class="control-group ">' +
					'			<label for="Folder_description" class="control-label">Description</label>' +
					'			<div class="controls"><textarea id="description_'+i+'" rows="4" class="span4"></textarea></div>' +
					'		</div>' +
					'		<div class="progress progress-striped active"><div id="uploadProgress_'+i+'" class="bar" style="width: 0%;"></div></div>' +
					'	</fieldset>' +
					'	</div>' +
					'</div>';
					i++;
					funAppendImage();
				}
				reader.readAsDataURL(file);
			} else {
				$("#preview").html(html);
				if (html) {
					//删除方法
					$(".upload_delete").click(function() {
						ZXXFILE.funDeleteFile(files[parseInt($(this).attr("data-index"))]);
						return false;
					});
					//提交按钮显示
					$("#fileSubmit").show();
				} else {
					//提交按钮隐藏
					$("#fileSubmit").hide();
				}
			}
		};
		funAppendImage();
	},

	onDelete: function(file) {
		$("#uploadList_" + file.index).fadeOut();
	},
	
	onDragOver: function() {
		$(this).addClass("upload_drag_hover");
	},
	
	onDragLeave: function() {
		$(this).removeClass("upload_drag_hover");
	},
	
	onProgress: function(file, loaded, total) {
		var eleProgress = $("#uploadProgress_" + file.index);
		percent = (loaded / total * 100).toFixed(2) + '%';
		eleProgress.css('width',percent);
	},
	
	onSuccess: function(file, response) {
		var arr=response.split('/');
		var id=arr[0];
		var filename=arr[1];
		$("#uploadInf").append('<div class="alert alert-block alert-success">' +
		'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
		'<h4>Success!</h4>'+filename+' has been uploaded successfully.' +
		'</div>');
	},
	
	onFailure: function(file) {
		//$("#uploadInf").append("<p>图片" + file.name + "上传失败！</p>");
		$("#uploadInf").append('<div class="alert alert-block alert-error">' +
		'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
		'<h4>Error!</h4>'+file.name+' has an error.' +
		'</div>');
		//$("#uploadImage_" + file.index).css("opacity", 0.2);
	},
	
	onComplete: function() {
		//提交按钮隐藏
		$("#fileSubmit").hide();
		//file控件value置空
		$("#fileImage").val("");
		//$("#uploadInf").append("<p>当前图片全部上传完毕，可继续添加上传。</p>");
		$("#uploadInf").append('<div class="alert alert-block alert-info">' +
		'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
		'<h4>Info</h4> All images in queue has been uploaded.' +
		'</div>');
	}
};

ZXXFILE = $.extend(ZXXFILE, params);
ZXXFILE.init(); 

