<?php


namespace A7Pro\Marketplace\Customer\Core\Domain\Models;


class Product
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const CONDITION_NEW = 0;
    const CONDITION_USED = 1;

    private ProductId $productId;
    private string $productName;
    private string $sellerId;
    private ?string $productMainPictId;
    private array $categories;
    private int $weight;
    private int $condition;
    private int $stock;
    private int $price;
    private bool $verified;
    private ?string $description;
    private Date $createdAt;
    private Date $updatedAt;
    private array $photos;

    public function __construct(
        ProductId $productId,
        array $categories,
        string $productName,
        int $stock,
        int $price,
        ?string $description,
        string $sellerId,
        int $weight,
        int $condition,
        ?string $productMainPictId = "",
        bool $verified = false,
        Date $createdAt = null,
        Date $updatedAt = null,
        array $photos = []
    ) {
        $this->productId = $productId;
        $this->categories = $categories;
        $this->productName = $productName;
        $this->stock = $stock;
        $this->price = $price;
        $this->verified = $verified;
        $this->description = $description;
        $this->sellerId = $sellerId;
        $this->weight = $weight;
        $this->condition = $condition;
        $this->productMainPictId = $productMainPictId;
        $this->createdAt = $createdAt ?: new Date(new \DateTime());
        $this->updatedAt = $updatedAt ?: new Date(new \DateTime());
        $this->photos = $photos;
    }

    /**
     * @return ProductId
     */
    public function getId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @return string
     */
    public function getCategory(): array
    {
        return $this->categories;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getSellerId()
    {
        return $this->sellerId;
    }

    public function getProductMainPictId()
    {
        return $this->productMainPictId;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getCondition(): string
    {
        return $this->condition;
    }

    /**
     * @return string
     */
    public static function getConditionText(int $condition): string
    {
        switch ($condition) {
            case self::CONDITION_NEW:
                return "New";

            default:
                return "Used";
        }
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getCreatedAt(): Date
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): Date
    {
        return $this->updatedAt;
    }

    public function ownedBy(string $sellerId): bool
    {
        return $this->sellerId == $sellerId;
    }

    public function hasPict(string $pictId): bool
    {
        $hasPict = false;
        foreach ($this->photos as $key => $value)
            if ($value->id == $pictId) {
                $hasPict = true;
                break;
            }

        return $hasPict;
    }

    public function validate(): array
    {
        $errors = [];

        if (!isset($this->sellerId))
            $errors[] = 'seller_id_must_be_specified';

        if (!isset($this->categories))
            $errors[] = 'category_must_be_specified';

        if (!isset($this->productName))
            $errors[] = 'product_name_must_be_specified';

        if (!isset($this->stock))
            $errors[] = 'stock_must_be_specified';

        if (!isset($this->price))
            $errors[] = 'price_must_be_specified';

        if (!isset($this->weight))
            $errors[] = 'weight_must_be_specified';

        if (!isset($this->condition))
            $errors[] = 'condition_must_be_specified';

        return $errors;
    }
}