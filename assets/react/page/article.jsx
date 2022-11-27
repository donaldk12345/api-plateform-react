import React, { useState, useEffect } from "react";
import { toast } from "react-toastify";
import articleService from '../services/article';
import Navigation from "./nav";
export default  function ArticlePage(props) {
    const[articles, setArticles] = useState([]);

    async function listArticles(){
        try{
            const data = await articleService.getArticles();
            setArticles(data)
            console.log(data);
            toast.success("Hello");
            
        }catch(error){
            console.log(error);
        }
    }
    useEffect(() => {
        listArticles();
      }, []);

      return (
        <div className="">
              <Navigation />
             <h2 className="text-center mt-3 display-4">Mes articles</h2>
            <div className="container col-12 m-auto">
             <div className="row justify-content-center">
                 
                    {
                        articles.map(
                            item  =>(
                                 <div className="col-md-6 col-lg-3 mb-3 " key={item.id}>
                                <div className="card">
                                <div className="card-header">
                                    <span> { item.title} </span>
                                 </div>
                                  <div className="card-body">
                                    <p> {item.content} </p>

                                  </div>
                                   <div className="card-footer">
                                        <span> {item.category.nom} </span>
                                   </div>
        
                                 </div>
                                 </div>

                            )
                        )
                    }

                  

          

             </div>
        </div>
        </div>
       
      )

}

