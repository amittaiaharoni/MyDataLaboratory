<?php

namespace MyDataLab\Bundle\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use MyDataLab\Bundle\UserBundle\Entity\User;
use MyDataLab\Bundle\CoreBundle\Entity\Language;

/**
 * Post
 */
class Post
{

    /**
     * @var int
     */
    private $id;

    /**
     *
     * @var User
     */
    private $author;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $metaDescription;

    /**
     *
     * @var string
     */
    private $image;

    /**
     *
     * @var \Datetime
     */
    private $createdAt;

    /**
     *
     * @var \Datetime
     */
    private $updatedAt;

    /**
     *
     * @var Collection
     */
    private $tags;

    /**
     *
     * @var string
     */
    private $content;

    /**
     *
     * @var Collection
     */
    private $keywords;

    /**
     *
     * @var Language
     */
    private $language;

    public function __construct()
    {
        $this->createdAt = new \Datetime('now');
        $this->updatedAt = new \Datetime('now');
        $this->tags = new ArrayCollection();
        $this->keywords = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return Post
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Get createdAt
     * 
     * @return \Datatime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get updatedAt
     * 
     * @return \Datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     * 
     * @param \Datetime $createdAt
     * @return Post
     */
    public function setCreatedAt(\Datetime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Set updatedAt
     * 
     * @param \Datetime $updatedAt
     * @return Post
     */
    public function setUpdatedAt(\Datetime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get tags
     * 
     * @return Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set tags
     * 
     * @param Collection $tags
     * @return Post
     */
    public function setTags(Collection $tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Add a tag
     * 
     * @param \MyDataLab\Bundle\BlogBundle\Entity\Tag $tag
     * @return Post
     */
    public function addTag(Tag $tag)
    {
        $this->tags->add($tag);
        return $this;
    }

    /**
     * Remove a tag
     * 
     * @param \MyDataLab\Bundle\BlogBundle\Entity\Tag $tag
     * @return Post
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
        return $this;
    }

    /**
     * Get keywords
     * 
     * @return Collection
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set keywords
     * 
     * @param Collection $keywords
     * @return Post
     */
    public function setKeywords(Collection $keywords)
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * Add a keyword
     * 
     * @param \MyDataLab\Bundle\BlogBundle\Entity\Keyword $keyword
     * @return Post
     */
    public function addKeyword(Keyword $keyword)
    {
        $this->keywords->add($keyword);
        return $this;
    }

    /**
     * Remove a keyword
     * 
     * @param \MyDataLab\Bundle\BlogBundle\Entity\Keyword $keyword
     * @return Post
     */
    public function removeKeyword(Keyword $keyword)
    {
        $this->keywords->removeElement($keyword);
        return $this;
    }

    /**
     * Get content
     * 
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * 
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get author
     * 
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set author
     * 
     * @param User $author
     * @return Post
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get image
     * 
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     * 
     * @param string $image
     * @return Post
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * 
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * 
     * @param Language $language
     * @return Post
     */
    public function setLanguage(Language $language)
    {
        $this->language = $language;
        return $this;
    }

}
