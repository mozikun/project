﻿var schoolList = [{
    "id": 1,
    "school":[
	//填入自己的json
	{"id":"1","name":"\u56db\u5ddd\u7701\u536b\u751f\u5385"},{"id":"3","name":"\u4e2d\u534e\u4eba\u6c11\u5171\u548c\u56fd\u536b\u751f\u90e8"},{"id":"4","name":"\u96c5\u5b89\u5e02\u536b\u751f\u5c40"},{"id":"5","name":"\u793e\u533a1"},{"id":"12","name":"\u68c9\u57ce\u793e\u533a\u536b\u751f\u670d\u52a1\u4e2d\u5fc3"},{"id":"13","name":"\u96c5\u5b89\u5e02\u7b2c\u4e00\u4eba\u6c11\u533b\u9662"},{"id":"14","name":"\u96c5\u5b89\u5e02\u7b2c\u4e8c\u4eba\u6c11\u533b\u9662"},{"id":"15","name":"\u536b\u751f\u5c40\u4fe1\u606f\u4e2d\u5fc3"},{"id":"16","name":"\u5bf9\u5ca9\u9547\u536b\u751f\u9662"},{"id":"17","name":"\u5357\u90ca\u4e61\u536b\u751f\u9662"},{"id":"18","name":"\u516b\u6b65\u4e61\u536b\u751f\u9662"},{"id":"19","name":"\u591a\u8425\u9547\u536b\u751f\u9662"},{"id":"20","name":"\u51e4\u9e23\u4e61\u536b\u751f\u9662"},{"id":"21","name":"\u664f\u573a\u9547\u536b\u751f\u9662"},{"id":"22","name":"\u671b\u9c7c\u4e61\u536b\u751f\u9662"},{"id":"23","name":"\u89c2\u5316\u4e61\u536b\u751f\u9662"},{"id":"24","name":"\u8349\u575d\u9547\u536b\u751f\u9662"},{"id":"25","name":"\u5408\u6c5f\u9547\u536b\u751f\u9662"},{"id":"26","name":"\u6c99\u576a\u9547\u536b\u751f\u9662"},{"id":"27","name":"\u5927\u5174\u9547\u536b\u751f\u9662"},{"id":"28","name":"\u4e2d\u91cc\u9547\u536b\u751f\u9662"},{"id":"29","name":"\u4e0a\u91cc\u9547\u536b\u751f\u9662"},{"id":"30","name":"\u59da\u6865\u9547\u536b\u751f\u9662"},{"id":"31","name":"\u5b54\u576a\u4e61\u536b\u751f\u9662"},{"id":"32","name":"\u5317\u90ca\u9547\u536b\u751f\u9662"},{"id":"33","name":"\u78a7\u5cf0\u5ce1\u9547\u536b\u751f\u9662"},{"id":"34","name":"\u4e25\u6865\u9547\u536b\u751f\u9662"},{"id":"35","name":"\u7075\u5173\u9547\u536b\u751f\u9662"},{"id":"36","name":"\u7a46\u576a\u9547\u536b\u751f\u9662"},{"id":"37","name":"\u9647\u4e1c\u9547\u536b\u751f\u9662"},{"id":"38","name":"\u5927\u6eaa\u4e61\u536b\u751f\u9662"},{"id":"39","name":"\u4e2d\u575d\u4e61\u536b\u751f\u9662"},{"id":"40","name":"\u4e94\u9f99\u4e61\u536b\u751f\u9662"},{"id":"41","name":"\u6c38\u5bcc\u4e61\u536b\u751f\u9662"},{"id":"42","name":"\u660e\u793c\u4e61\u536b\u751f\u9662"},{"id":"43","name":"\u7857\u789b\u4e61\u536b\u751f\u9662"},{"id":"44","name":"\u76d0\u4e95\u4e61\u536b\u751f\u9662"},{"id":"45","name":"\u6c11\u6cbb\u4e61\u536b\u751f\u9662"},{"id":"46","name":"\u5bcc\u6797\u9547\u536b\u751f\u9662"},{"id":"47","name":"\u4e5d\u8944\u9547\u536b\u751f\u9662"},{"id":"48","name":"\u4e4c\u65af\u6cb3\u9547\u536b\u751f\u9662"},{"id":"49","name":"\u5b9c\u4e1c\u9547\u536b\u751f\u9662"},{"id":"50","name":"\u5bcc\u5e84\u9547\u536b\u751f\u9662"},{"id":"51","name":"\u6e05\u6eaa\u9547\u536b\u751f\u9662"},{"id":"52","name":"\u5927\u6811\u9547\u536b\u751f\u9662"},{"id":"53","name":"\u7687\u6728\u9547\u536b\u751f\u9662"},{"id":"54","name":"\u5927\u7530\u4e61\u536b\u751f\u9662"},{"id":"55","name":"\u5510\u5bb6\u4e61\u536b\u751f\u9662"},{"id":"56","name":"\u5bcc\u6625\u4e61\u536b\u751f\u9662"},{"id":"57","name":"\u6cb3\u897f\u4e61\u536b\u751f\u9662"},{"id":"58","name":"\u5927\u5cad\u4e61\u536b\u751f\u9662"},{"id":"59","name":"\u524d\u57df\u4e61\u536b\u751f\u9662"},{"id":"60","name":"\u540e\u57df\u4e61\u536b\u751f\u9662"},{"id":"61","name":"\u5927\u5830\u4e61\u536b\u751f\u9662"},{"id":"62","name":"\u4e24\u6cb3\u4e61\u536b\u751f\u9662"},{"id":"63","name":"\u4e09\u4ea4\u4e61\u536b\u751f\u9662"},{"id":"64","name":"\u53cc\u6eaa\u4e61\u536b\u751f\u9662"},{"id":"65","name":"\u897f\u6eaa\u4e61\u536b\u751f\u9662"},{"id":"66","name":"\u5efa\u9ece\u4e61\u536b\u751f\u9662"},{"id":"67","name":"\u5e02\u8363\u4e61\u536b\u751f\u9662"},{"id":"68","name":"\u5bcc\u6cc9\u4e61\u536b\u751f\u9662"},{"id":"69","name":"\u4e07\u5de5\u4e61\u536b\u751f\u9662"},{"id":"70","name":"\u5b89\u4e50\u4e61\u536b\u751f\u9662"},{"id":"71","name":"\u4e07\u91cc\u4e61\u536b\u751f\u9662"},{"id":"72","name":"\u5bcc\u4e61\u4e61\u536b\u751f\u9662"},{"id":"73","name":"\u68a8\u56ed\u4e61\u536b\u751f\u9662"},{"id":"74","name":"\u9a6c\u70c8\u4e61\u536b\u751f\u9662"},{"id":"75","name":"\u767d\u5ca9\u4e61\u536b\u751f\u9662"},{"id":"76","name":"\u9752\u5bcc\u4e61\u536b\u751f\u9662"},{"id":"77","name":"\u6842\u8d24\u4e61\u536b\u751f\u9662"},{"id":"78","name":"\u6cb3\u5357\u4e61\u536b\u751f\u9662"},{"id":"79","name":"\u6652\u7ecf\u4e61\u536b\u751f\u9662"},{"id":"80","name":"\u6599\u6797\u4e61\u536b\u751f\u9662"},{"id":"81","name":"\u5c0f\u5821\u85cf\u65cf\u5f5d\u65cf\u4e61\u536b\u751f\u9662"},{"id":"82","name":"\u7247\u9a6c\u5f5d\u65cf\u4e61\u536b\u751f\u9662"},{"id":"83","name":"\u576d\u7f8e\u5f5d\u65cf\u4e61\u536b\u751f\u9662"},{"id":"84","name":"\u6c38\u5229\u5f5d\u65cf\u4e61\u536b\u751f\u9662"},{"id":"85","name":"\u987a\u6cb3\u5f5d\u65cf\u4e61\u536b\u751f\u9662"},{"id":"86","name":"\u5927\u5ddd\u9547\u536b\u751f\u9662"},{"id":"87","name":"\u601d\u5ef6\u4e61\u536b\u751f\u9662"},{"id":"88","name":"\u6e05\u4ec1\u4e61\u536b\u751f\u9662"},{"id":"89","name":"\u592a\u5e73\u9547\u536b\u751f\u9662"},{"id":"90","name":"\u53cc\u77f3\u9547\u536b\u751f\u9662"},{"id":"91","name":"\u9f99\u95e8\u4e61\u536b\u751f\u9662"},{"id":"92","name":"\u5b9d\u76db\u4e61\u536b\u751f\u9662"},{"id":"93","name":"\u98de\u4ed9\u5173\u9547\u536b\u751f\u9662"},{"id":"94","name":"\u82a6\u9633\u9547\u536b\u751f\u9662"},{"id":"95","name":"\u57ce\u53a2\u9547\u536b\u751f\u9662"},{"id":"96","name":"\u59cb\u9633\u9547\u536b\u751f\u9662"},{"id":"97","name":"\u5c0f\u6cb3\u4e61\u536b\u751f\u9662"},{"id":"98","name":"\u601d\u7ecf\u4e61\u536b\u751f\u9662"},{"id":"99","name":"\u9c7c\u6cc9\u4e61\u536b\u751f\u9662"},{"id":"100","name":"\u7d2b\u77f3\u4e61\u536b\u751f\u9662"},{"id":"101","name":"\u4e24\u8def\u4e61\u536b\u751f\u9662"},{"id":"102","name":"\u5927\u576a\u4e61\u536b\u751f\u9662"},{"id":"103","name":"\u4e50\u82f1\u4e61\u536b\u751f\u9662"},{"id":"104","name":"\u591a\u529f\u4e61\u536b\u751f\u9662"},{"id":"105","name":"\u4ec1\u4e49\u4e61\u536b\u751f\u9662"},{"id":"106","name":"\u8001\u573a\u4e61\u536b\u751f\u9662"},{"id":"107","name":"\u65b0\u534e\u4e61\u536b\u751f\u9662"},{"id":"108","name":"\u65b0\u573a\u4e61\u536b\u751f\u9662"},{"id":"109","name":"\u5174\u4e1a\u4e61\u536b\u751f\u9662"},{"id":"110","name":"\u767e\u4e08\u9547\u536b\u751f\u9662"},{"id":"111","name":"\u8499\u9633\u9547\u536b\u751f\u9662"},{"id":"112","name":"\u6c38\u5174\u9547\u536b\u751f\u9662"},{"id":"113","name":"\u65b0\u5e97\u9547\u536b\u751f\u9662"},{"id":"114","name":"\u8f66\u5cad\u9547\u536b\u751f\u9662"},{"id":"115","name":"\u9a6c\u5cad\u9547\u536b\u751f\u9662"},{"id":"116","name":"\u7ea2\u661f\u9547\u536b\u751f\u9662"},{"id":"117","name":"\u57ce\u4e1c\u4e61\u536b\u751f\u9662"},{"id":"118","name":"\u4e2d\u5cf0\u4e61\u536b\u751f\u9662"},{"id":"119","name":"\u9ed1\u7af9\u9547\u536b\u751f\u9662"},{"id":"120","name":"\u8499\u9876\u5c71\u9547\u536b\u751f\u9662"},{"id":"121","name":"\u524d\u8fdb\u4e61\u536b\u751f\u9662"},{"id":"122","name":"\u4e07\u53e4\u4e61\u536b\u751f\u9662"},{"id":"123","name":"\u89e3\u653e\u4e61\u536b\u751f\u9662"},{"id":"124","name":"\u8054\u6c5f\u4e61\u536b\u751f\u9662"},{"id":"125","name":"\u5ed6\u573a\u4e61\u536b\u751f\u9662"},{"id":"126","name":"\u53cc\u6cb3\u4e61\u536b\u751f\u9662"},{"id":"127","name":"\u7ea2\u5ca9\u4e61\u536b\u751f\u9662"},{"id":"128","name":"\u5efa\u5c71\u4e61\u536b\u751f\u9662"},{"id":"129","name":"\u8305\u6cb3\u4e61\u536b\u751f\u9662"},{"id":"130","name":"\u68c9\u57ce\u8857\u9053\u529e\u4e8b\u5904\u536b\u751f\u9662"},{"id":"131","name":"\u65b0\u68c9\u9547\u536b\u751f\u9662"},{"id":"132","name":"\u5b89\u987a\u5f5d\u65cf\u4e61\u536b\u751f\u9662"},{"id":"133","name":"\u5148\u950b\u85cf\u65cf\u4e61\u536b\u751f\u9662"},{"id":"134","name":"\u87f9\u87ba\u85cf\u65cf\u4e61\u536b\u751f\u9662"},{"id":"135","name":"\u6c38\u548c\u4e61\u536b\u751f\u9662"},{"id":"136","name":"\u56de\u9686\u5f5d\u65cf\u4e61\u536b\u751f\u9662"},{"id":"137","name":"\u64e6\u7f57\u5f5d\u65cf\u4e61\u536b\u751f\u9662"},{"id":"138","name":"\u6817\u5b50\u576a\u5f5d\u65cf\u4e61\u536b\u751f\u9662"},{"id":"139","name":"\u7f8e\u7f57\u4e61\u536b\u751f\u9662"},{"id":"140","name":"\u8fce\u653f\u4e61\u536b\u751f\u9662"},{"id":"141","name":"\u5bb0\u7f8a\u4e61\u536b\u751f\u9662"},{"id":"142","name":"\u4e30\u4e50\u4e61\u536b\u751f\u9662"},{"id":"143","name":"\u65b0\u6c11\u85cf\u65cf\u5f5d\u65cf\u4e61\u536b\u751f\u9662"},{"id":"144","name":"\u6316\u89d2\u5f5d\u65cf\u85cf\u65cf\u4e61\u536b\u751f\u9662"},{"id":"145","name":"\u7530\u6e7e\u5f5d\u65cf\u4e61\u536b\u751f\u9662"},{"id":"146","name":"\u8349\u79d1\u85cf\u65cf\u4e61\u536b\u751f\u9662"},{"id":"147","name":"\u4e25\u9053\u9547\u536b\u751f\u9662"},{"id":"148","name":"\u82b1\u6ee9\u9547\u536b\u751f\u9662"},{"id":"149","name":"\u516d\u5408\u4e61\u536b\u751f\u9662"},{"id":"150","name":"\u70c8\u592a\u4e61\u536b\u751f\u9662"},{"id":"151","name":"\u77f3\u6865\u4e61\u536b\u751f\u9662"},{"id":"152","name":"\u5b89\u9756\u4e61\u536b\u751f\u9662"},{"id":"153","name":"\u51f0\u4eea\u4e61\u536b\u751f\u9662"},{"id":"154","name":"\u6c11\u5efa\u4e61\u536b\u751f\u9662"},{"id":"155","name":"\u70c8\u58eb\u4e61\u536b\u751f\u9662"},{"id":"156","name":"\u8365\u6cb3\u4e61\u536b\u751f\u9662"},{"id":"157","name":"\u65b0\u5efa\u4e61\u536b\u751f\u9662"},{"id":"158","name":"\u6cd7\u576a\u4e61\u536b\u751f\u9662"},{"id":"159","name":"\u65b0\u5e99\u4e61\u536b\u751f\u9662"},{"id":"160","name":"\u4e09\u5408\u4e61\u536b\u751f\u9662"},{"id":"161","name":"\u5927\u7530\u575d\u4e61\u536b\u751f\u9662"},{"id":"162","name":"\u5e99\u5c97\u4e61\u536b\u751f\u9662"},{"id":"163","name":"\u77f3\u9f99\u4e61\u536b\u751f\u9662"},{"id":"164","name":"\u5929\u51e4\u4e61\u536b\u751f\u9662"},{"id":"165","name":"\u5b9d\u5cf0\u4e61\u536b\u751f\u9662"},{"id":"166","name":"\u590d\u987a\u4e61\u536b\u751f\u9662"},{"id":"167","name":"\u9644\u57ce\u4e61\u536b\u751f\u9662"},{"id":"168","name":"\u4e94\u5baa\u4e61\u536b\u751f\u9662"},{"id":"169","name":"\u70df\u7af9\u4e61\u536b\u751f\u9662"},{"id":"170","name":"\u9752\u9f99\u4e61\u536b\u751f\u9662"},{"id":"171","name":"\u77f3\u6ed3\u4e61\u536b\u751f\u9662"},{"id":"172","name":"\u96e8\u57ce\u533a\u536b\u751f\u5c40"},{"id":"173","name":"\u540d\u5c71\u53bf\u536b\u751f\u5c40"},{"id":"174","name":"\u8365\u7ecf\u53bf\u536b\u751f\u5c40"},{"id":"175","name":"\u6c49\u6e90\u53bf\u536b\u751f\u5c40"},{"id":"176","name":"\u77f3\u68c9\u53bf\u536b\u751f\u5c40"},{"id":"177","name":"\u5929\u5168\u53bf\u536b\u751f\u5c40"},{"id":"178","name":"\u82a6\u5c71\u53bf\u536b\u751f\u5c40"},{"id":"179","name":"\u5b9d\u5174\u53bf\u536b\u751f\u5c40"},{"id":"180","name":"\u5987\u5e7c\u533b\u9662"},{"id":"181","name":"\u77f3\u68c9\u53bf\u4e2d\u533b\u533b\u9662"},{"id":"182","name":"\u8365\u7ecf\u53bf\u4eba\u6c11\u533b\u9662"},{"id":"185","name":"\u5cf0\u6876\u5be8\u4e61\u536b\u751f\u9662"},{"id":"186","name":"\u76d0\u536b\u751f\u9662"},{"id":"187","name":"\u660e\u536b\u751f\u9662"},{"id":"188","name":"\u4e0b\u6c6a\u5bb6\u62d0\u793e\u533a"},{"id":"189","name":"\u6c34\u78be\u6cb3\u8def\u793e\u533a"},{"id":"190","name":"\u9752\u7f8a\u533a\u536b\u751f\u5c40"},{"id":"191","name":"\u96e8\u57ce\u533a\u4e2d\u5fc3\u536b\u751f\u9662"},{"id":"192","name":"\u96e8\u57ce\u533a\u6d4b\u8bd5\u673a\u67841"}
	//
	],
    
	"name": "雅安市"
}

]