var messages = [];

// var questions = []; // haetaan kannasta tähän kaikki kysymykset
// var answerID = [];	// jokaiselle kysymykselle on oma vastausID, jolla voidaan hakea kannasta tiettyä vastausta

var newMessage = document.getElementById("newMsg"); 
var msgTable = document.getElementById("messages"); 
 
var question = -1;
var ala = 0; // 1 = tieto, 2 = kone, 3 = sähkö
 
 ChatBot("");
 
 newMessage.addEventListener("keyup", function(event)
 {
	event.preventDefault();
	
	if (event.keyCode === 13)
	{
		ChatBot(newMessage.value);
		newMessage.value = "";
	}
 });
 
 function LoadQuestions()
 {
	 // lataa kysymykset kannasta ja laittaa ne questions-tauluun
	 // laittaa niiden vastaus iideet answerID-tauluun
	$.get("lataa.php", function(data)
	{
		var res = data.split("\n");
		
		for (var i = 0; i < res.length - 1; i++)
		{
			var d = res[i].split("_");
			answerID.push(parseInt(d[0]));
			questions.push(d[1]);
		}
	});
 } 
 
 function ChatBot(msg)
 {
	//omateksti -------------------------------------
	if (msg != "")
	{
		SetText("Sina: " + msg);
	}
	
	//botin vastaus --------------------------------
	var vastaus = "Botti: ";
        
        if (question == 0 || question < 0)
        {
            if (msg != "")
            {
                var answered = false;
                
                if (msg.includes("terve") || msg.includes("moi") || msg.includes("hei") || msg.includes("moro") || msg.includes("mo"))
                {
                    switch (randomNum(0, 2))
                    {
                        case 0:
                            vastaus += "moi";
                            break;
                        case 1:
                            vastaus += "hei";
                            break;
                        case 2:
                            vastaus += "moro";
                            break;
                        case 3:
                            vastaus += "terve";
                            break;
                    }
                    
					SetText(vastaus);
                    answered = true;
                }
                
                // laskin
                 if (msg.includes("laske"))
                 {
                    var laskutoimitus = "";
                    
                    for(var i = 0; i < msg.length; i++)
                    {
                       if(!isNaN(parseInt(msg.charAt(i), 10)) || msg.charAt(i) == '-' || msg.charAt(i) == '+' || msg.charAt(i) == '*' || 
                               msg.charAt(i) == '/' || msg.charAt(i) == '.' || msg.charAt(i) == '^' || msg.charAt(i) == '(' || msg.charAt(i) == ')')
                       {
                           laskutoimitus += msg.charAt(i);
                       }
                    }
                     
					 
					 SetText("Botti: " + laskutoimitus + " = " + eval(laskutoimitus));
                    
                    answered = true;
                 }
                 
                 if (msg.includes("paivamaara"))
                 {
                     var d = new Date();
                     SetText("Botti: Nyt on " + d.getDate() + "." + (d.getMonth() + 1) + "." + d.getFullYear());
                     
                     answered = true;
                 }
                 
                 if (msg.includes("kello"))
                 {
					 
                     var d = new Date();
                     SetText("Botti: kello on " + d.getHours() + ":" + d.getMinutes());
                     
                     answered = true;
                 }
                 
				 
				 // haetaan vastaus kannasta--------------------------
				 
				if (answered == false)
				{
					var answerID = -1;
					$.get("lataa.php?k=" + msg, function(data)
					{
						answerID = parseInt(data);
						
						$.get("lataa.php?v=" + answerID, function(data)
						{
							SetText("Botti: " + data)
						});
						
						if (answerID != -1)
						{
							answered = true;
						}
						else
						{
							// lähettää viestin tietokantaan, jos botti ei osannut vastata
							answered == false;
							SetText("Viesti lähetetty kantaan.");
							Send(msg);
						}
						
					});
				}
				  
            }
            else
            {
                if (question == -1)
                {
                    vastaus += "Minkä alan opiskelija olet?";
                    question = 1;
                    SetText(vastaus);
                }
            }
        }
        else
        {
            switch (question)
            {
                case 1:
                    
                    if (msg.includes("tietotek") || msg.includes("Tietotek"))
                    {
                        vastaus += "Ok";
                        ala = 1;
                        question = 0;
                        SetText(vastaus);
                    }
                    
                    if (msg.includes("konetek") || msg.includes("Konetek"))
                    {
                        vastaus += "Ok";
                        ala = 2;
                        question = 0;
                        SetText(vastaus);
                    }
                    
                    if (msg.includes("sähkötek") || msg.includes("Sähkötek"))
                    {
                        vastaus += "Ok";
                        ala = 3;
                        question = 0;
                        SetText(vastaus);
                    }
                    
                    break; 
            }
        }
		
		
	}
	
	
	// lähettää viestin tietokantaan
	function Send(x)
	{
		$.ajax({
		type: 'POST',
		data: { 'k': x },
		url: 'tallenna.php',
		// dataType: 'json',
		
	  });
	}
	function randomNum (min, max)
    {
        var i = min + (Math.random() * ((max - min) + 1));
        return Math.round(i);
    }
	
	function SetText (t)
	{
		messages.push(t);
		var newMsg = "";
		for (var i = 0; i < messages.length; i++)
		{
			newMsg += "<tr><td>" + messages[i] + "</td></tr>";
		}
		msgTable.innerHTML = newMsg;
	}
