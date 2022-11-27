import http from "../../http";

async function getArticles() {
    return http.get("/articles").then((response) => {
        const articles = response.data["hydra:member"];
        return articles;
    });
};

const articleService = {
    getArticles

};

export default articleService;