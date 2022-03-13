import { NewsArticle } from "../types/NewsArticle";
import axios from "axios";

interface APINewsArticle {
    title: string;
    publishDate: string;
    author: string;
    description: string;
    link: string;
}

export interface NewsQueryoptions {
    search: string
    feed?:'isif-asia' | 'apnic-blog'
} 


export const fetchNewsArticles = async (
    options: NewsQueryoptions): Promise<Array<NewsArticle>> => {
       const { data } = await axios.get(
        `http://localhost:8080/wp-json/apnic-foundation-news/news-feed`,
        {
            params: {
                feed: options.feed,
                search: options.search
            }
        }
    );
    console.log('data:', data)
    return data.map((raw: APINewsArticle) => {
        return {
            title: raw.title,
            publishDate: new Date(raw.publishDate), // TODO: Fix Me!
            author: raw.author,
            description: raw.description,
            link: raw.link,
        };
    });
};
