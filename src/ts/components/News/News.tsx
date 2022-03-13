import React, { useEffect, useState } from "react";
import Button from "react-bootstrap/Button";
import { Card, FormControl, FormSelect, InputGroup } from "react-bootstrap";
import { NewsArticle } from "../../types/NewsArticle";
import { fetchNewsArticles, NewsQueryoptions } from "../../api/NewsArticles";

function News() {
    const [newsArticles, setNewsArticles] = useState<Array<NewsArticle>>([]);
    const [selectedOptions , setSelectedOptions] = useState<NewsQueryoptions>({feed:'isif-asia', search : ''})
    useEffect(() => {
        fetchNewsAndSetState()
    }, []);


    function fetchNewsAndSetState(){
        fetchNewsArticles(selectedOptions).then((newsArticles) => {
            setNewsArticles(newsArticles);
        });
    }
    return (
        <Card>
            <Card.Header>
                <InputGroup 
                    onChange={(e:any) => {
                        setSelectedOptions({
                            ...selectedOptions,
                            search : e.target.value
                        })
                    }}
                className="mb-2">
                    <FormControl />
                    <Button onClick = { () => {
                        fetchNewsAndSetState()
                    }} variant="primary">Search</Button>
                </InputGroup>
                <div className="row">
                    <div className="col-md-9" />
                    <div className="col-md-3">
                        <FormSelect 
                            value={selectedOptions.feed}
                        onChange={(e:any) => {
                         console.log(e.target.value)
                           setSelectedOptions({
                               ...selectedOptions,
                               feed : e.target.value
                           })
                           fetchNewsAndSetState()
                        }}>
                            <option disabled={true}>Select News Feed</option>
                            <option value='isif-asia'>isif-asia</option>
                            <option value='apnic-blog'>apnic-blog</option>
                        </FormSelect>
                    </div>
                </div>
            </Card.Header>
            <Card.Body>
                {newsArticles &&
                    newsArticles.sort((item1, item2) => {
                        return (item2.publishDate as any) - (item1.publishDate as any)
                    })
                    .map((newsArticle) => {
                        return (
                            <Card className="mb-3">
                                <Card.Header>
                                    <a href={newsArticle.link}>
                                        <h2 className="h4 mb-2">
                                            {newsArticle.title}
                                        </h2>
                                    </a>
                                    <div className="d-flex">
                                        <div style={{ marginRight: "15px" }}>
                                            {newsArticle.author}
                                        </div>
                                        <div>
                                            {newsArticle.publishDate.toDateString()}
                                            <span style={{margin:'0 10px'}}>
                                                <a href={newsArticle.link} target='_blank'>Source</a>
                                            </span>
                                        </div>
                                    </div>
                                </Card.Header>

                                <Card.Body>
                                    {newsArticle.description}
                                </Card.Body>
                            </Card>
                        );
                    })}
            </Card.Body>
        </Card>
    );
}

export default News;
